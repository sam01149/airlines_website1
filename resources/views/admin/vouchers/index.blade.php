@extends('layout.app')

@section('title', 'Admin - Kelola Voucher')

@section('content')
<main class="dashboard-container" style="max-width: 1000px;">
    <h1>Kelola Voucher Diskon</h1>
    <p style="font-size: 1.1rem; color: #e0e7ff; margin-bottom: 2rem;">Tambah, edit, atau hapus voucher promosi.</p>

    <div style="text-align: right; margin-bottom: 20px;">
        <a href="{{ route('admin.vouchers.create') }}" class="button" style="color:rgb(220, 181, 66)">
            <i  class="fas fa-plus"></i> Tambah Voucher Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert-message success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="member-table">
            <thead>
                <tr>
                    <th>Kode Voucher</th>
                    <th>Diskon (%)</th>
                    <th>Status</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vouchers as $voucher)
                    <tr>
                        <td><strong>{{ $voucher->code }}</strong></td>
                        <td>{{ $voucher->discount_percentage }}%</td>
                        <td>
                            @if ($voucher->is_active)
                                <span style="color: #6bff6b;">Aktif</span>
                            @else
                                <span style="color: #ff6b6b;">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>{{ $voucher->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="button small-button" style="background-color: #3a8dff;color:white;padding: 0.5rem 1rem;
        font-size: 0.85rem;
        border-radius: 20px;
        margin: 0 5px;">Edit</a>
                            <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button small-button" style="background-color: #dc3545;color:black;padding: 0.5rem 1rem;
        font-size: 0.85rem;
        border-radius: 20px;
        margin: 0 5px;" onclick="return confirm('Anda yakin ingin menghapus voucher ini?');"> Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Belum ada voucher yang dibuat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('admin.dashboard') }}" class="button" style="background-color:rgb(220, 181, 66);border-radius:30px;color:black; width: auto; padding: 12px 30px;" >Kembali ke Dashboard Admin</a>
    </div>
</main>
@endsection