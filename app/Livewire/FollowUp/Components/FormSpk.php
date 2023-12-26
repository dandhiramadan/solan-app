<?php

namespace App\Livewire\FollowUp\Components;

use Carbon\Carbon;
use App\Models\Spk;
use App\Models\Task;
use Livewire\Component;
use App\Models\Customer;
use App\Models\WorkStep;
use App\Models\Instruction;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

#[Title('Form SPK')]
class FormSpk extends Component
{
    use WithFileUploads;

    #[Rule('required', message: 'Tipe SPK harus diisi.')]
    public $spkType;

    #[Rule('required', message: 'Customer harus diisi.')]
    public $customerSelected;
    public $customerName;
    public $customerTaxes;

    public $subSpk;
    public $spkParent;

    #[Rule('required', message: 'SPK Number harus diisi.')]
    public $spkNumber;

    public $spkFsc;
    public $fscType;
    public $spkNumberFsc;

    #[Rule('required', message: 'Tanggal PO Masuk harus diisi.')]
    public $orderDate;

    #[Rule('required', message: 'Tanggal Permintaan Kirim harus diisi.')]
    public $deliveryDate;

    public $focCustomerNumber;

    #[Rule('required', message: 'Customer number harus diisi.')]
    public $customerNumber;

    #[Rule('required', message: 'Nama Order harus diisi.')]
    public $orderName;

    public $codeStyle;

    #[Rule('required', message: 'Quantity harus diisi.')]
    public $quantity;

    #[Rule('required', message: 'Followup harus diisi.')]
    public $followUp;

    public $price;
    public $ppn;

    #[Rule('required', message: 'Panjang Barang harus diisi.')]
    public $panjangBarang;

    #[Rule('required', message: 'Lebar Barang harus diisi.')]
    public $lebarBarang;

    public $spkLayout;
    public $spkSample;
    public $spkStock;

    // #[Rule('required', message: 'File contoh harus diisi.')]
    public $fileContoh;
    public $fileArsip;
    public $fileAccounting;

    public $langkahKerja = [];
    public $id = 0;

    public $state;
    public $user_auth;

    public function rules()
    {
        return [
            'langkahKerja' => 'required|array|min:1',
            'langkahKerja.*.description' => 'required|string',
        ];
    }

    public function mount($state)
    {
        $this->state = $state;
        $this->user_auth = Auth()->user()->id;
    }

    public function render()
    {
        return view('livewire.follow-up.components.form-spk', [
            'customer' => Customer::all(),
            'parent' => Instruction::where('state', 1)->get(),
            'layout' => Instruction::where('spk_type', 'layout')->get(),
            'sample' => Instruction::where('spk_type', 'sample')->get(),
            'stock' => Instruction::where('spk_type', 'stock')->get(),
            'workStep' => WorkStep::all(),
        ]);
    }

    public function addLangkahKerja($description)
    {
        $this->id++;
        $this->langkahKerja[] = [
            'description' => $description,
            'sortorder' => $this->id,
            'state' => null,
            'jumlah' => null,
        ];
    }

    public function removeLangkahKerja($key)
    {
        unset($this->langkahKerja[$key]);
        $this->langkahKerja = array_values($this->langkahKerja);
    }

    public function updateTaskOrder($list)
    {
        foreach ($list as $index => $item) {
            $value = $item['value'];
            $this->langkahKerja[$value]['sortorder'] = $index + 1;
        }

        $this->langkahKerja = array_values($this->langkahKerja);

        usort($this->langkahKerja, function ($a, $b) {
            return $a['sortorder'] - $b['sortorder'];
        });
    }

    public function save()
    {
        $this->validate();

        $cekCustomerNumber = Instruction::where('purchase_order', $this->customerNumber)
            ->where('state', 0)
            ->where('foc', 0)
            ->first();

        if ($cekCustomerNumber) {
            session()->flash('error', 'Nomor Purchase Order sudah terpakai sebelumnya !!! ');
        } else {
            $cekSpkNumber = Instruction::where('spk_number', $this->spkNumber)->first();
            if ($cekSpkNumber) {
                session()->flash('error', 'Nomor SPK sudah terpakai sebelumnya !!! ');
            } else {
                try {
                    DB::beginTransaction();
                    $createSpk = Instruction::create([
                        'condition' => 'new',
                        'spk_number' => $this->spkNumber,
                        'spk_type' => $this->spkType,
                        'taxes_type' => $this->customerTaxes,
                        'state' => ($this->subSpk === null || $this->subSpk === false) && $this->spkParent === null ? 0 : (($this->subSpk !== null || $this->subSpk !== false) && $this->spkParent === null ? 1 : 2),
                        'parent' => ($this->subSpk === null || $this->subSpk === false) && $this->spkParent === null ? null : (($this->subSpk !== null || $this->subSpk !== false) && $this->spkParent === null ? $this->spkNumber : $this->spkParent),
                        'customer_name' => $this->customerName,
                        'spk_fsc' => $this->spkFsc === null || $this->spkFsc === false ? 0 : 1,
                        'fsc_type' => $this->fscType,
                        'spk_number_fsc' => $this->spkNumberFsc,
                        'order_date' => $this->orderDate,
                        'delivery_date' => $this->deliveryDate,
                        'initial_delivery_date' => json_encode($this->deliveryDate),
                        'foc' => $this->focCustomerNumber === null || $this->focCustomerNumber === false ? 0 : 1,
                        'purchase_order' => $this->customerNumber,
                        'order_name' => $this->orderName,
                        'code_style' => $this->codeStyle,
                        'quantity' => currency_convert($this->quantity),
                        'followup' => $this->followUp,
                        'price' => currency_convert($this->price),
                        'ppn' => $this->ppn,
                        'panjang_barang' => currency_convert($this->panjangBarang),
                        'lebar_barang' => currency_convert($this->lebarBarang),
                        'spk_layout' => $this->spkLayout,
                        'spk_sample' => $this->spkSample,
                        'spk_stock' => $this->spkStock,
                    ]);

                    if ($createSpk->state != 2) {
                        $updateSpkNumber = Spk::where('type', $this->spkType)
                            ->where('taxes', $this->customerTaxes)
                            ->first();
                        if ($updateSpkNumber) {
                            $updateSpkNumber->increment('total');
                        }
                    }

                    $now = Carbon::now();
                    $orderDate = Carbon::parse($this->orderDate);
                    $deliveryDate = Carbon::parse($this->deliveryDate);

                    $days = $orderDate->diffInDays($deliveryDate);
                    $hoursPerDay = 11;
                    $totalDuration = $days * $hoursPerDay;

                    $createProject = Task::create([
                        'instruction_id' => $createSpk->id,
                        'user_id' => 1,
                        'text' => $createSpk->order_name,
                        'duration' => $totalDuration,
                        'start_date' => $now,
                        'parent' => 0,
                        'sortorder' => 0,
                        'progress' => 1,
                        'type' => null,
                        'readonly' => 'true',
                        'state' => 'Process',
                    ]);

                    foreach ($this->langkahKerja as $data) {
                        $createTask = Task::create([
                            'instruction_id' => $createSpk->id,
                            'user_id' => null,
                            'text' => $data['description'],
                            'duration' => 1,
                            'start_date' => $now,
                            'parent' => $createProject->id,
                            'sortorder' => $data['sortorder'],
                            'progress' => 0,
                            'type' => 'task',
                            'readonly' => null,
                        ]);
                    }

                    DB::commit();

                    try {
                        DB::beginTransaction();
                        $completedTask = Task::where('instruction_id', $createSpk->id)
                            ->where('text', 'Follow Up')
                            ->first();

                        $nextTask = Task::where('instruction_id', $createSpk->id)->where('sortorder', '>', $completedTask->sortorder)
                            ->orderBy('sortorder')
                            ->first();

                        if ($nextTask) {
                            $nextTask->start_date = $now;
                            $nextTask->state = 'Pending Approved';
                            $nextTask->save();

                            $updateStatusPekerjaan = Task::where('instruction_id', $createSpk->id)->update([
                                'status' => 'Pending Approved',
                                'pekerjaan' => $nextTask->text,
                            ]);
                        }

                        $updateTaskFollowup = Task::where('instruction_id', $createSpk->id)
                            ->where('text', 'Follow Up')
                            ->update([
                                'user_id' => $this->user_auth,
                                'state' => 'Process',
                                'duration' => 1,
                                'start_date' => $now,
                            ]);

                        DB::commit();
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
                    }
                } catch (\Throwable $th) {
                    DB::rollBack();
                    session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
                }
            }
        }
    }

    public function updatedFocCustomerNumber()
    {
        if ($this->focCustomerNumber == true) {
            $this->customerNumber = 'FOC';
        } else {
            $this->customerNumber;
        }
    }

    public function updatedCustomerSelected()
    {
        $dataCustomer = Customer::find($this->customerSelected);
        $this->customerName = $dataCustomer->name;

        if ($this->spkType == 'production') {
            $this->customerTaxes = $dataCustomer->taxes;
        } else {
            $this->customerTaxes = 'nonpajak';
        }

        return;
    }

    public function updatedSpkType()
    {
        if ($this->spkType == 'production') {
            $this->customerTaxes;
        } else {
            $this->customerTaxes = 'nonpajak';
        }

        return;
    }

    public function generateSpkNumber()
    {
        $this->validate(
            [
                'spkType' => 'required',
                'customerSelected' => 'required',
            ],
            [
                'spkType.required' => 'Tipe SPK harus diisi.',
                'customerSelected.required' => 'Pemesan harus diisi.',
            ],
        );

        $now = Carbon::now();
        $spkType = $this->spkType;
        $spkTaxes = $this->customerTaxes;
        $spkSub = $this->subSpk;
        $spkParent = $this->spkParent;

        try {
            DB::beginTransaction();
            $totalSpk = Spk::where('year', $now->year)
                ->where('type', $spkType)
                ->where('taxes', $spkTaxes)
                ->first();

            if ($totalSpk) {
                $total = $totalSpk->total;
            } else {
                $createTotalSpk = Spk::create([
                    'year' => $now->year,
                    'type' => $spkType,
                    'taxes' => $spkTaxes,
                    'total' => 0,
                ]);

                $totalSpk = Spk::where('year', $now->year)
                    ->where('type', $spkType)
                    ->where('taxes', $spkTaxes)
                    ->first();

                $total = $totalSpk->total;
            }

            if ($spkType === 'layout' || $spkType === 'sample') {
                $totalLayoutSample = Spk::where('year', $now->year)
                    ->whereIn('type', ['layout', 'sample'])
                    ->where('taxes', $spkTaxes)
                    ->sum('total');

                $this->spkNumber = 'P-' . sprintf('%04d', $totalLayoutSample + 1);
            } elseif ($spkType === 'production') {
                if ($spkTaxes == 'pajak') {
                    if ($spkSub == false && $spkParent == null) {
                        $this->spkNumber = 'SLN' . date('y') . '-' . sprintf('%04d', $total + 1);
                    } elseif ($spkSub == true && $spkParent == null) {
                        $this->spkNumber = 'SLN' . date('y') . '-' . sprintf('%04d', $total + 1) . '-A';
                    } else {
                        $dataChild = Instruction::where('parent', $spkParent)->count();
                        if ($dataChild == 0) {
                            $alphabet = 'A';
                            $code = ++$alphabet;
                        } else {
                            $alphabet = chr(65 + (($dataChild - 1) % 26));
                            $code = ++$alphabet;
                        }
                        $nomorParent = Str::between($spkParent, '-', '-');
                        $this->spkNumber = 'SLN' . date('y') . '-' . sprintf($nomorParent) . '-' . sprintf($code);
                    }
                } else {
                    $totalNonPajak = Spk::where('year', $now->year)
                        ->whereIn('type', ['production', 'stock'])
                        ->where('taxes', 'nonpajak')
                        ->sum('total');

                    if ($spkSub == false && $spkParent == null) {
                        $this->spkNumber = date('y') . '-' . sprintf('%04d', $totalNonPajak + 1);
                    } elseif ($spkSub == true && $spkParent == null) {
                        $this->spkNumber = date('y') . '-' . sprintf('%04d', $totalNonPajak + 1) . '-A';
                    } else {
                        $dataChild = Instruction::where('parent', $spkParent)->count();
                        if ($dataChild == 0) {
                            $alphabet = 'A';
                            $code = ++$alphabet;
                        } else {
                            $alphabet = chr(65 + (($dataChild - 1) % 26));
                            $code = ++$alphabet;
                        }
                        $alphabet = chr(65 + (($dataChild - 1) % 26));
                        $nomorParent = Str::between($spkParent, '-', '-');
                        $this->spkNumber = date('y') . '-' . sprintf($nomorParent) . '-' . sprintf($code);
                    }
                }
            } else {
                $totalNonPajak = Spk::where('year', $now->year)
                    ->whereIn('type', ['production', 'stock'])
                    ->where('taxes', 'nonpajak')
                    ->sum('total');

                if ($spkSub == false && $spkParent == null) {
                    $this->spkNumber = date('y') . '-' . sprintf('%04d', $totalNonPajak + 1);
                } elseif ($spkSub == true && $spkParent == null) {
                    $this->spkNumber = date('y') . '-' . sprintf('%04d', $totalNonPajak + 1) . '-A';
                } else {
                    $dataChild = Instruction::where('parent', $spkParent)->count();
                    $alphabet = chr(65 + (($dataChild - 1) % 26));
                    $nomorParent = Str::between($spkParent, '-', '-');
                    $this->spkNumber = date('y') . '-' . sprintf($nomorParent) . '-' . sprintf(++$alphabet);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
        }
    }

    public function generateSpkNumberFsc()
    {
        $this->validate(
            [
                'fscType' => 'required',
                'spkFsc' => 'required',
                'spkNumber' => 'required',
            ],
            [
                'fscType.required' => 'Tipe FSC harus dipilih.',
                'spkFsc.required' => 'SFC harus dipilih.',
                'spkNumber.required' => 'SPk Number harus diisi.',
            ],
        );

        $this->spkNumberFsc = 'FSC-' . sprintf($this->spkNumber) . '(' . sprintf($this->fscType) . ')';
    }
}
