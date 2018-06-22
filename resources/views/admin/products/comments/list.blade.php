@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">

    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($comments)
            <div class="box">
                <div class="box-body">
                    <h2>Customers</h2>
                    @include('layouts.search', ['route' => route('admin.customers.index')])
                    <table class="table">
                        <thead>
                        <tr>
                            <td class="col-md-2">ID</td>
                            <td class="col-md-2">Name</td>
                            <td class="col-md-2">Email</td>
                            <td class="col-md-2">Status</td>
                            <td class="col-md-4">Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment['id'] }}</td>
                                <td>{{ $comment['product_id'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $comments->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection