@extends('layouts.pengguna-back')
@section('main')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ ucwords($menu) }}</h1>
        <p class="mb-4">List Detail {{ ucwords($menu) }}</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ ucwords($menu) }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="tabel-orang-tua">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        @foreach ($data as $key => $value)
                            <tr>
                                <td style="border-right: none !important;">
                                    {{ $key }}
                                </td>
                                <td style="border-left: none !important; border-right: none !important;">
                                    :
                                </td>
                                <td style="border-left: none !important;">
                                    {{ $value }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
