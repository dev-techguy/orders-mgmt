<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200 h-screen">
    <div id="app" class="w-2/3 mx-auto">
        <div class="panel">
            <form action="">
                <h4 class="text-xl">Add new order</h4>
                <div class="w-full mt-2">
                    <label class="flex">
                        <span class="text-gray-700 w-1/6 flex items-center">User</span>
                        <select class="form-select mt-1 w-1/3 h-10">
                            <option>John Smith</option>
                            <option>Laura Stone</option>
                            <option>Jon Olsson</option>
                          </select>
                    </label>
                </div>
                <div class="w-full mt-2">
                    <label class="flex">
                        <span class="text-gray-700 w-1/6 flex items-center">Product</span>
                        <select class="form-select mt-1 w-1/3 h-10">
                            <option>Fanta</option>
                            <option>Coca Cola</option>
                            <option>Pepsi Cola</option>
                          </select>
                    </label>
                </div>
                <div class="w-full mt-2">
                    <label class="flex">
                        <span class="text-gray-700 w-1/6 flex items-center">Quantity</span>
                        <input class="form-input mt-1 w-1/3 h-10" type="number" min="1">
                    </label>
                </div>
                <div class="w-full mt-2 flex">
                    <div class="w-1/2 flex justify-end">
                        <button class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded">
                            add
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="panel mt-4 shadow">
            <form action="">
                <div class="w-full flex items-center">
                    <div class="w-1/4">
                        <label for="">
                            <select name="" id="" class="form-select">
                                <option value="all">All time</option>
                                <option value="7">Last 7 days</option>
                                <option value="today">Today</option>
                            </select>
                        </label>
                    </div>
                    <div class="w-1/2">
                        <input type="text" class="form-input w-full h-10" placeholder="enter search item">
                    </div>
                    <div class="w-1/4 px-2 flex justify-end">
                        <button class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded">
                            search
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="panel">
            <table class="app-table table-auto w-full">
                <thead>
                  <tr>
                    <th>User</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="text-sm">
                  <tr>
                    <td>John Smith</td>
                    <td>Coca Cola</td>
                    <td>1.80 EUR</td>
                    <td>3</td>
                    <td>5.40 EUR</td>
                    <td>15 Sep 2017, 8:56 AM</td>
                    <td>Edit | Delete</td>
                  </tr>
                  <tr>
                    <td>Laura Stone</td>
                    <td>Adam</td>
                    <td>112</td>
                    <td>112</td>
                    <td>112</td>
                    <td>112</td>
                    <td>112</td>
                  </tr>
                  <tr>
                    <td>John Olsson</td>
                    <td>Chris</td>
                    <td>1,280</td>
                    <td>1,280</td>
                    <td>1,280</td>
                    <td>1,280</td>
                    <td>1,280</td>
                  </tr>
                  <tr>
                    <td>John Smith</td>
                    <td>Coca Cola</td>
                    <td>1.80 EUR</td>
                    <td>3</td>
                    <td>5.40 EUR</td>
                    <td>15 Sep 2017, 8:56 AM</td>
                    <td>
                        <span class="text-green-500"><a href="#">Edit</a></span> | 
                        <span class="text-red-500"><a href="#">Delete</a></span>
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
    <script src="js/app.js"></script>
</body>
</html>