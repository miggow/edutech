@extends('panel.app')
@section('css')
@endsection
@section('content')

<div class="card p-4">
        <h4 class="fw-bold py-3 mb-4">Danh sách các khóa học đã mua</h4>
        <div class="table-responsive">
            <table class="table font-14 ">
                <tr>
                    <th class="text-left">Tiêu đề khóa học</th>
                    <th class="text-left">Phương thức thanh toán</th>
                    <th>Giá</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                </tr>

                @foreach ($orders as $order)
                    @if ($order->course)
                        <tr>
                            <td>
                                <strong>
                                    <a href="{{ route('learn.index', $order->course->id) }}">{{ $order->course->title }}</a>
                                    {{-- <a href="{{ route('FE.course_detail', $course->id) }}">{{ $course->title }}</a> --}}
                                </strong>
                                <div class="text-small">
                                    {{ empty($order->course->category) ? '' : $order->course->category->name }}</div>
                            </td>
                            <td>{{ config('payment_method')[$order->payment_method]['name'] }}</td>
                            <td>{{ $order->price == 0 ? 'Miễn phí' : number_format($order->price, 0, '', '.') }}
                                VND
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>

                            <td>
                                <div
                                    class="{{ $order->course->status == 1 ? 'badge bg-label-success me-1' : 'badge bg-label-warning me-1' }}">
                                    {{ $order->course->status == 1 ? 'Đang hoạt động' : 'Ngưng hoạt động' }}</div>
                            </td>

                        </tr>
                    @endif
                @endforeach


            </table>
        </div>
    </div>
    {{-- <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table " id="user-table">
                <thead>
                    <tr>
                        <th>Tên khóa học</th>
                        <th>Giá tiền</th>
                        <th>Ngày mua</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->course->title }}</td>
                            <td>{{ $order->price == 0 ? 'Miễn phí' : number_format($order->price, 0, '', '.') }}
                                VND
                            </td>
                            <td> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div> --}}
@endsection

@section('js')
@endsection
