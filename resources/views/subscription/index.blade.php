<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-15 mx-auto">
            <div class="flex flex-wrap -m-4">
                <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                    <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative bg-white overflow-hidden">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">Basic</h2>
                        <h1 class="text-5xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">Free</h1>

                        <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded" disabled>Purchased
{{--                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">--}}
{{--                                <path d="M5 12h14M12 5l7 7-7 7"></path>--}}
{{--                            </svg>--}}
                        </button>
                    </div>
                </div>
                <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                    <div class="h-full p-6 rounded-lg border-2 border-indigo-500 flex flex-col relative bg-white overflow-hidden">
                        <span class="bg-indigo-500 text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl">POPULAR</span>
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">Silver</h2>
                        <h1 class="text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>1500</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/mo</span>
                        </h1>

                        <button class="flex items-center mt-auto text-white bg-indigo-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-indigo-600 rounded">Purchase</button>
                    </div>
                </div>
                <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                    <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative bg-white overflow-hidden">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">Gold</h2>
                        <h1 class="text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>5000</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/mo</span>
                        </h1>

                        <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">Purchase</button>
                    </div>
                </div>
                <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                    <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative bg-white overflow-hidden">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">Platinum</h2>
                        <h1 class="text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>N/A</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/mo</span>
                        </h1>
                        <button class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">Purchase</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-gray-600 body-font">
        <div class="container mx-auto">
            <div class="lg:w-2/9 w-full mx-auto overflow-auto">
                <table class="table-auto bg-white overflow-hidden w-full text-left whitespace-no-wrap">
                    <thead>
                    <tr>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm text-center bg-gray-100 rounded-tl rounded-bl">Functions</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm text-center bg-gray-100">Basic</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm text-center bg-gray-100">Silver</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm text-center bg-gray-100">Gold</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm text-center bg-gray-100">Platinum</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="px-4 py-3 text-center">Subscription For 1 year</td>
                        <td class="px-4 py-3 text-center">Free</td>
                        <td class="px-4 py-3 text-center">1500</td>
                        <td class="px-4 py-3 text-center">5000</td>
                        <td class="px-4 py-3 text-center">Free (5 million purchases / month)</td>
                    </tr>
                    <tr>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Registeration</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                    </tr>
                    <tr>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Quotations</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">5</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">10</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Unlimited</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">EmdadTools</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3">Free</td>
                        <td class="border-t-2 text-center border-gray-200 px-4 py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">Super Admin (CEO role)</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">1</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">2</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">10</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">Users</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">2</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">10</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">100</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">Truck</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">5</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">20</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">Unlimited</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                    </tr>
                    <tr>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">Driver</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">5</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">20</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3">Unlimited</td>
                        <td class="border-t-2 text-center border-b-2 border-gray-200 px-4 py-3"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--                <x-jet-welcome />--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</x-app-layout>

<script>
    function language(rtl_value) {
        $.ajax({
            url: "{{route('languageChange')}}",
            method: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                rtl_value: rtl_value,
            },
            success: function(){
                window.location.reload();
            },
            // error: function(result){
            //     console.log('error');
            // }
        });
    }
</script>
