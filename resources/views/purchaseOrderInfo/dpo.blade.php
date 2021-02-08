<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - Welcome {{ auth()->user()->gender == 'Male' ? 'Mr. ' . Auth::user()->name : 'Mrs.' . Auth::user()->name }}
            <span class="float-right text-red-900 font-bold">{{ isset(Auth::user()->status) == 1 ? 'Under process' : 'InComplete' }}</span>
            <span class=" float-right text-black-600 font-bold">Account Status:&nbsp;&nbsp;</span>
        </h2>
    </x-slot>
    <style>
        table,
        th,
        tr,
        td {
            border: 1px solid black;
        }
    </style>
    @role('SuperAdmin')
    <div class="bg-white">
        <div class="border-solid border-4 border-blue-500">
            {{-- Start of invoice template design --}}
            <body class="antialiased sans-serif bg-white">
                <div class="">
                    <div class="flex justify-between bg-gray-200">
                        <div class="w-full m-4">
                            <div class="flex ">
                                <div class="mb-2 md:mb-1  items-center">
                                    <img src="{{ url('/1.jpg') }}" class="w-20 h-20" alt="Image" />
                                    <div>
                                        <label class="text-3xl text-gray-800 block mt-10 font-bold text-sm
                                tracking-wide">Nadec Co.</label>
                                    </div>
                                </div>
                                <div class="mb-2 ml-44 items-center">
                                    <label class="text-2xl text-gray-800 block mt-10 font-bold text-sm
                                tracking-wide">DRAFT P.O</label>
                                </div>
                                <div class="mb-2 items-center ml-80">
                                    <img src="{{ url('/2.jpg') }}" class="w-40 h-20" alt="Image" />
                                    <div>
                                        <label class="text-2xl text-gray-800 block mt-10 font-bold text-sm
                                            tracking-wide">Java Time Cofee</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-between bg-white mt-2">
                        <div class="w-full md:w-1/3 mb-2 md:mb-0">
                            <label class="text-gray-800 block mb-1 font-bold
                         text-sm uppercase tracking-wide ml-2">Purchase From</label>
                            <label class="font-bold mb-2 ml-2">Nadec Co.</label>
                            <label class="text-gray-800 block mb-1 font-bold
                        text-sm uppercase tracking-wide ml-2">ID: &nbsp &nbsp &nbsp S45DS</label>
                            <label class="mb-7 text-gray-800 block mb-1 font-bold
                        text-sm uppercase tracking-wide ml-2">Location: &nbsp &nbsp &nbsp Riyadh</label>
                            <label class="text-gray-800 block mb-1 font-bold
                        text-sm uppercase tracking-wide ml-2">Sales Name: &nbsp &nbsp &nbsp Mr.Ahsan</label>
                            <label class="text-gray-800 block mb-1 font-bold
                        text-sm uppercase tracking-wide ml-2">ID: &nbsp &nbsp &nbsp 36472</label>
                        </div>
                        <div class="w-full md:w-1/3 mb-2 md:mb-0 mt-2">
                            <label class="text-gray-800 block mb-1 font-bold
                         text-sm uppercase tracking-wide">Deliver To</label>
                            <label class="font-bold mb-2">Java Time Cofee</label>
                            <label class="text-gray-800 block mb-1 font-bold
                        text-sm uppercase tracking-wide">ID: &nbsp &nbsp &nbsp S45DS</label>
                            <label class="mb-7 text-gray-800 block mb-1 font-bold
                        text-sm uppercase tracking-wide">City: &nbsp &nbsp &nbsp Jeddah</label>
                            <label class="text-gray-800 block mb-1 font-bold
                        text-sm uppercase tracking-wide">Buyer Name: &nbsp &nbsp &nbsp Mr.Abdulaziz</label>
                            <label class="text-gray-800 block mb-1 font-bold
                        text-sm uppercase tracking-wide">ID: &nbsp &nbsp &nbsp 36472</label>
                        </div>
                        <div class="mb-5 border-solid border-2 border-black  md:w-1/3 bg-gray-300">
                            <label class="text-black-800 font-bold text-2xl	 block mb-1 font-bold
                         text-sm uppercase tracking-wide ml-7">DRAFT P.O</label>
                            <label class="text-gray-800 block mb-1 font-bold
                         text-sm uppercase tracking-wide ml-2">Date: &nbsp &nbsp &nbsp &nbsp
                                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span class="font-bold text-xl"> S45DS</span></label>
                            <label class="text-gray-800 block mb-1 font-bold
                          text-sm uppercase tracking-wide ml-2">D..P.O.No#: &nbsp &nbsp &nbsp &nbsp
                                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span class="font-bold text-xl"> 1/31/2021</span></label>
                            <label class="text-gray-800 block mb-1 font-bold
                           text-sm uppercase tracking-wide ml-2">RFQ#: &nbsp &nbsp &nbsp &nbsp
                                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 3281</label>
                            <label class="text-gray-800 block mb-1 font-bold
                            text-sm uppercase tracking-wide ml-2">Qout: &nbsp &nbsp &nbsp &nbsp
                                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span class="font-bold text-xl"> 14562</span></label>
                            <label class="text-gray-800 block mb-1 font-bold
                             text-sm uppercase tracking-wide ml-2">Payment Term: &nbsp &nbsp &nbsp &nbsp
                                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Cash</label>
                        </div>
                    </div>
                    <body class="flex items-center justify-center">
                        <div class="container">
                            <table class="w-full">
                                <thead class="text-black bg-gray-300" style="border: 3px solid rgb(12, 11, 11)">
                                    <tr class="">
                                        <th>#</th>
                                        <th>tem Code</th>
                                        <th>Description</th>
                                        <th>Quality</th>
                                        <th>UOM</th>
                                        <th Packing="110px">Actions</th>
                                        <th>Brand</th>
                                        <th>Unit Price</th>
                                        <th width="110px">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="flex-1 sm:flex-none">
                                    <tr>
                                        <td>1</td>
                                        <td>234-0001</td>
                                        <td>Fresh Milk</td>
                                        <td>22</td>
                                        <td>EACH</td>
                                        <td>1</td>
                                        <td>Nadec</td>
                                        <td>12</td>
                                        <td>264.00</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>234-0002</td>
                                        <td>Yogurt - Low fat</td>
                                        <td>21</td>
                                        <td>EACH</td>
                                        <td>1</td>
                                        <td>Nadec</td>
                                        <td>1</td>
                                        <td>21.00</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>234-0003
                                        </td>
                                        <td>Juice Diff. Flavors
                                        </td>
                                        <td>200
                                        </td>
                                        <td>EACH
                                        </td>
                                        <td>1</td>
                                        <td>Nadec
                                        </td>
                                        <td>1</td>
                                        <td>200.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>234-0004
                                        </td>
                                        <td>Fresh Butter
                                        </td>
                                        <td>10
                                        </td>
                                        <td>EACH
                                        </td>
                                        <td>1</td>
                                        <td>Nadec
                                        </td>
                                        <td>7</td>
                                        <td>70.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="mt-8"> Remarks :
                                            <input type="text" class="mt-10 " height="100" style="border: 3px solid rgb(12, 11, 11)">
                                        </td>
                                        <td>
                                        <td>
                                        </td>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </body>
                    <style>
                        html,
                        body {
                            height: 100%;
                        }
                        @media (min-width: 640px) {
                            table {
                                display: inline-table !important;
                            }
                            thead tr:not(:first-child) {
                                display: none;
                            }
                        }
                        td:not(:last-child) {
                            border-bottom: 0;
                        }
                        th:not(:last-child) {
                            border-bottom: 2px solid rgba(0, 0, 0, .1);
                        }
                    </style>
                </div>
        </div>
        </body>
        {{-- End of invoice template design --}}
    </div>
    </div>
    @endrole
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
