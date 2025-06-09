@extends('layout.app')

@section('title', 'Admin - Edit Voucher')

@section('content')
<main class="form-container" style="max-width: 600px;">
    <h1>Edit Voucher</h1>

    <form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="code">Kode Voucher:</label>
            <input type="text" id="code" name="code" value="{{ old('code', $voucher->code) }}" required>
             @error('code') <small style="color: #ff6b6b;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="discount_percentage">Persentase Diskon (%):</label>
            <input type="number" id="discount_percentage" name="discount_percentage" step="0.01" min="1" max="100" value="{{ old('discount_percentage', $voucher->discount_percentage) }}" required>
            @error('discount_percentage') <small style="color: #ff6b6b;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group" style="display: flex; align-items: center;">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ $voucher->is_active ? 'checked' : '' }} style="width: auto; margin-right: 10px;">
            <label for="is_active" style="margin-bottom: 0;">Aktifkan voucher ini</label>
        </div>

        <button type="submit" class="form-submit-button">Perbarui Voucher</button>
    </form>
</main>
@endsection