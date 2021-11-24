<label class="block font-medium text-sm text-gray-700 mb-2">
    {{__('portal.Mobile Number')}} <span class="text-red-500">*</span> ({{__('portal.without')}} +966)
</label>
<input
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "9" minlength="9" pattern="([5][0-9]{8})"
    type = "tel" name="mobile" placeholder="{{__('portal.e.g.')}} 523456789" class="form-input rounded-md shadow-sm block my-2 w-full" value="{{old('mobile')}}">
