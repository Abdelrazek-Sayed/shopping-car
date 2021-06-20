  @extends('layouts.master')
  @section('content')
      <div class="row">


          <div class="row">
              <div class="col-md-9">
                  @foreach ($orders as $order)
                      <div class="card mb-3">
                          <div class="card-body">

                              <table class="table table-striped mt-2 mb-2">
                                  <thead>
                                      <tr>
                                          <th scope="col">Name</th>
                                          <th scope="col">Price</th>
                                          <th scope="col">Quantity</th>
                                          <th scope="col">status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($order->items as $item)
                                          <tr>

                                              <td>{{ $item['item']['title'] }}</td>
                                              <td>${{ $item['price'] }}</td>
                                              <td>{{ $item['qty'] }}</td>
                                              <td> Paid</td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>

                          </div>
                      </div>
                      <p class="btn btn-success">Total Price :
                          ${{ $order->totalPrice }}
                      </p>
                  @endforeach
              </div>
          </div>
      </div>
  @endsection
