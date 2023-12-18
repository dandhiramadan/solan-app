<div>
<!-- Toast with Placements -->
<div
class="bs-toast toast toast-placement-ex m-2"
role="alert"
aria-live="assertive"
aria-atomic="true"
data-bs-delay="2000">
<div class="toast-header">
  <i class="ti ti-bell ti-xs me-2"></i>
  <div class="me-auto fw-medium">Bootstrap</div>
  <small class="text-muted">11 mins ago</small>
  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
</div>
<div class="toast-body">Hello, world! This is a toast message.</div>
</div>
<!-- Toast with Placements -->
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('broadcast', (data) => {
            const toastEx = document.querySelector(".toast-ex"),
            toastPlacementEx = document.querySelector(".toast-placement-ex");
            let animationType, animationClass, toastInstance, placementType, placementClasses;

            function disposeToast(instance) {
                if (instance && null !== instance._element) {
                    toastPlacementEx && (toastPlacementEx.classList.remove(animationType),
                        toastPlacementEx.querySelector(".ti").classList.remove(animationType),
                        DOMTokenList.prototype.remove.apply(toastPlacementEx.classList, placementClasses));

                    toastEx && (toastEx.classList.remove(animationType, placementType),
                        toastEx.querySelector(".ti").classList.remove(animationType));

                    instance.dispose();
                }
            }

            disposeToast(toastInstance);
            animationType = 'text-primary';
            placementType = 'bottom-0 start-0';
            placementClasses = placementType.split(" ");
            toastPlacementEx.querySelector(".ti").classList.add(animationType);
            DOMTokenList.prototype.add.apply(toastPlacementEx.classList, placementClasses);
            toastInstance = new bootstrap.Toast(toastPlacementEx);
            toastInstance.show();
        });
    });
</script>
@endpush
