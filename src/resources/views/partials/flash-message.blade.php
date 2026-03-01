<div class="fixed bottom-6 right-6 z-50 flex flex-col gap-4 max-w-sm w-full">
    <!-- Success Toast Variant -->
    @if (session()->has('success'))
        <div id="successToast"
            class="bg-toast-bg dark:bg-[#1e2e22] rounded-lg border border-[#ebf0ec] dark:border-[#2d3a30] overflow-hidden toast-shadow flex flex-col relative group">
            <div class="p-4 flex gap-3 items-center">
                <div class="flex-shrink-0">
                    <span class="material-symbols-outlined text-[#428a50] text-2xl font-bold">check_circle</span>
                </div>
                <div class="flex-1">
                    <h4 class="text-[#121713] dark:text-white text-sm font-bold leading-tight">{{ session('success') }}</h4>
                </div>
                <button onclick="closeToast('successToast')" class="text-[#638369] hover:text-[#121713] dark:hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            <!-- Progress Bar (Success) - Visual 10s countdown indicator -->
            <div class="progress h-[3px] w-full bg-[#ebf0ec] dark:bg-green-500/20">
                <div class="h-full bg-green-500" style="width: 100%;"></div>
            </div>
        </div>
    @endif
    <!-- Error Toast Variant -->
    @if(session()->has('error'))
        <div id="errorToast"
            class="bg-toast-bg dark:bg-[#2a1b1b] rounded-lg border border-red-100 dark:border-red-900 overflow-hidden toast-shadow flex flex-col relative group">
            <div class="p-4 flex gap-3 items-center">
                <div class="flex-shrink-0">
                    <span class="material-symbols-outlined text-red-500 text-2xl font-bold">error</span>
                </div>
                <div class="flex-1">
                    <h4 class="text-[#121713] dark:text-white text-sm font-bold leading-tight">{{ session('error') }}</h4>
                </div>
                <button onclick="closeToast('errorToast')" class="text-[#638369] hover:text-[#121713] dark:hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            <!-- Progress Bar (Error) - Visual 10s countdown indicator -->
            <div class="progress h-[3px] w-full bg-red-100 dark:bg-red-500/20">
                <div class="h-full bg-red-500" style="width: 100%;"></div>
            </div>
        </div>
    @endif
</div>

<style>
    .toast-animation {
        animation: toast 10s ease-in-out;
    }

    @keyframes toast {
        from{
            width: 100%;
        }
        to{
            width: 0;
        }
    }
</style>

<script>
    const successToast = document.getElementById('successToast');
    const errorToast = document.getElementById('errorToast');

    if (successToast) {
        const progressBar = successToast.querySelector('.progress');
        progressBar.classList.add('toast-animation');
        setTimeout(() => {
            successToast.classList.add('hidden');
            progressBar.classList.remove('toast-animation');
        }, 10000);
    }

    if (errorToast) {
        const progressBar = errorToast.querySelector('.progress');
        progressBar.classList.add('toast-animation');
        setTimeout(() => {
            errorToast.classList.add('hidden');
            progressBar.classList.remove('toast-animation');
        }, 10000);
    }

    function closeToast(id) {
        const toast = document.getElementById(id);
        toast.classList.add('hidden');
    }
</script>
