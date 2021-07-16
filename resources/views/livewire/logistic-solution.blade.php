<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sr. No
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Solution
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status (On/Off)
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    1
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                Packaging Solution
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="switch">
                                    <input type="checkbox" name="PackagingSolution" @if($PackagingSolution) disabled @endif wire:model="PackagingSolution">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>


                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    2
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                Storage Solution
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="switch">
                                    <input type="checkbox" name="StorageSolution" @if($StorageSolution) disabled @endif  wire:model="StorageSolution">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>


                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    3
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                Local Cargo
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="switch">
                                    <input type="checkbox" name="LocalCargo"  @if($LocalCargo) disabled @endif  wire:model="LocalCargo">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>


                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    4
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                International Cargo
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="switch">
                                    <input type="checkbox" name="InternationalCargo" @if($InternationalCargo) disabled @endif wire:model="InternationalCargo">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>

                        <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
