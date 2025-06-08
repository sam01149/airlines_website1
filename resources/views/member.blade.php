@extends('layout/app')
<main style="max-width: 800px; margin: auto; padding: 20px;">
    
    <h1>DATA MEMBER</h1>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;
        background-color: #f9f9f9;">
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                background-color: #f9f9f9;
            }
            th, td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
                color: black;
            }
            th {
                background-color:rgb(37, 114, 221);
                color: white;
                ;
            }
            </style>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Tanggal Login</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type onclick="window.location.href='/dashboard'" style="float:right;width:100px">exit</button>
       
</main>

@section('content')