<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>
    <div class="mt-5" style="text-align: center;">
        <a class="inline-flex items-center justify-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white
        uppercase tracking-widest focus:outline-none focus:border-red-700">
            List of Incomplete Registered Users
        </a>
    </div>
    @include('users.sessionMessage')

    <div class="flex flex-col mt-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr class="bg-green-500 text-center text-black font-bold">
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                Name
                            </th>

                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                Email
                            </th>

                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                Mobile Number
                            </th>

                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                National ID Number
                            </th>

                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                National ID Expiry Date
                            </th>

                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                Created At
                            </th>

                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($incompleteBusiness as $business)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                    <a class="text-white md:text-blue-600"> {{ $business->name }} </a>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                    <a class="text-white md:text-blue-600"> {{ $business->email }} </a>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                    <a class=" text-blue-900 ">{{ $business->mobile }}</a>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                    <a class="hover:underline text-blue-900 ">{{ $business->nid_num }}</a>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                    <a class="hover:underline text-blue-900 ">{{ \Illuminate\Support\Carbon::parse($business->nid_exp_date)->format('d-M-Y') }}</a>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                    <a class="hover:underline text-blue-900 ">{{ \Illuminate\Support\Carbon::parse($business->created_at)->format('d-M-Y') }}</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    <span class="pl-4">{{ $incompleteBusiness->withQueryString()->links() }}</span>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>
