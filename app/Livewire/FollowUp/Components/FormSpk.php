<?php

namespace App\Livewire\FollowUp\Components;

use Livewire\Component;
use App\Models\WorkStep;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class FormSpk extends Component
{
    use WithFileUploads;

    #[Rule('required', message: 'Pemesan harus diisi.')]
    public $customer_name;

    #[Rule('required', message: 'Customer number harus diisi.')]
    public $customer_number;

    #[Rule('required', message: 'File contoh harus diisi.')]
    public $file_contoh;

    public $langkahKerja = [];
    public $id = 0;

    public function rules()
    {
        return [
            'langkahKerja' => 'required|array|min:1',
            'langkahKerja.*.description' => 'required|string',
        ];
    }

    public function mount()
    {
        // $this->state = $state;
    }

    public function render()
    {
        return view('livewire.follow-up.components.form-spk',[
            'workStep' => WorkStep::all(),
        ]);
    }

    public function addLangkahKerja($description)
    {
        $this->id++;
        $this->langkahKerja[] = ['description' => $description, 'sortorder' => $this->id];
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
        dd($this->langkahKerja);
    }
}
