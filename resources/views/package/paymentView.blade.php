<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-black text-2xl text-center">
                        @if($checkPackageManualPayment->status == 0)
                            {{__('portal.Payment Status')}}: <span class="text-yellow-400">{{__('portal.Emdad verification pending')}}</span>
                        @elseif($checkPackageManualPayment->status == 2)
                            {{__('portal.Payment Status')}}: <span class="text-red-600">{{__('portal.Emdad rejected manual payment')}}</span><br>
                            <a href="{{route('manualPackagePaymentView', encrypt($checkPackageManualPayment->package_id))}}" class="inline-flex items-center add-more hover:text-white px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center" style="justify-content: center; cursor: pointer">{{__('portal.Update')}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
