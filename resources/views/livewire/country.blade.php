<div class="flex space-x-5 mt-3">
    <x-jet-input id="phone" type="tel" name="phone" class="border p-2 w-1/2" required></x-jet-input>
    <x-jet-input id="mobile" type="number" name="mobile" class="border p-2 w-1/2" required></x-jet-input>
    <select name="country" id="country" wire:model="country" class="form-select rounded-md shadow-sm border p-2 w-1/2" required>
        <option value="">None</option>
        @foreach (\App\Models\User::countries() as $country)
            <option value="{{ $country }}">{{ $country }}</option>
        @endforeach
    </select>

    <select name="country" id="city" class="form-select select2 rounded-md shadow-sm border p-2 w-1/2" required>
        <option value="Other" selected>Other</option>
        @foreach ($list as $city)
            <option value="{{ $city->name_en }}">{{ $city->name_en . ' - ' . $city->name_ar }}</option>
        @endforeach
    </select>
</div>
