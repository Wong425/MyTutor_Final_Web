<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>MainPage</title>
    <style>
    body {
        font- family: 'Nunito', sans-serif;
        background: url("{{asset('images/1.jpg')}}")
    }

    .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 13px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
    }

    .button5 {
        background-color: white;
        color: black;
        border: 2px solid #555555;
    }

    .button5:hover {
        background-color: #555555;
        color: white;
    }

    @media screen and (max-width: 768px) {
        .w3-container {
            width: 100%;
        }
    }

    @media screen and (min-width: 768px) {
        .w3-container {
            width: 100%;
            margin: 0 auto;
        }
    }
    </style>

</head>

<body>
    @if (session('save'))
    <script>
    alert("Success");
    </script>
    @endif
    @if (session('error'))
    <script>
    alert("Failed");
    </script>
    @endif

    <header class="w3-center w3-padding w3-black">
        <a class="w3-round w3-button w3-right w3-black" href="{{ url('logout') }}">
            Logout</a>
        <h2>Subject List</h2>
        <div>
            <button class="button button5 w3-round w3-right w3-margin"
                onclick="document.getElementById('newitem').style.display= 'block';return false;">New Subject</button>
        </div>

    </header>


    <div class="w3-white w3-padding-large" style='max-width:100%;margin:auto'>
        <table class="w3-table w3-striped w3-bordered">
            <thead>
                <th>No</th>
                <th>ID</th>
                <th>Code</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price (RM)</th>
                <th>Total Learning Hours</th>
            </thead>
            @foreach ($listSubjects as $listItem)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $listItem->id}}</td>
                <td>{{ $listItem->subject_id}}</td>
                <td>{{ $listItem->title}}</td>
                <td>{{ $listItem->description}}</td>
                <td>{{ $listItem->price}}</td>
                <td>{{ $listItem->learning_hours}}</td>
                <td>
                    <div class="w3-cell">
                        <form method="post" action="{{route('markDelete',$listItem->id)}}" accept-charset="UTF-8"
                            onsubmit="return confirm('Delete?');">
                            {{csrf_field()}}
                            <button class="button button5 w3-round w3-block" type="submit">
                                <i class="fa fa-trash"> </i></button>
                        </form>
                    </div>
                    <div class="w3-cell">
                        <button class="button button5 w3-round w3-block"
                            onclick="document.getElementById('{{$loop->iteration}}').style.display='block';return false;"><i
                                class="fa fa-pencil-square-o"> </i>
                        </button>
                    </div>
                    <div id="{{$loop->iteration}}" class="w3-modal w3-animate-opacity">
                        <div class="w3-modal-content w3-round" style="width:500px">
                            <header class="w3-row w3-black"> <span
                                    onclick="document.getElementById('{{$loop->iteration}}').style.display='none'"
                                    class="button button5 w3-display-topright w3-small">&times;</span>
                                <h4 class="w3-margin-left">Update Subject Form</h4>
                            </header>
                            <div class="w3-padding">
                                <form method="post" action="{{route('markUpdate',$listItem->id)}}">
                                    {{csrf_field()}}
                                    <p><input class="w3-input w3-round w3-border" type="text" name="sbid"
                                            placeholder="Code" value="{{ $listItem->subject_id}}"></p>
                                    <p><input class="w3-input w3-round w3-border" type="text" name="sbname"
                                            placeholder="Name" value="{{ $listItem->title}}"></p>
                                    <p><input class="w3-input w3-round w3-border" type="text" name="sbdes"
                                            placeholder="Description" value="{{ $listItem->description}}"></p>
                                    <p><input class="w3-input w3-round w3-border" type="number" name="sbprice"
                                            placeholder="Price" step="any" value="{{ $listItem->price}}"></p>
                                    <p><input class="w3-input w3-round w3-border" type="text" name="sblh"
                                            placeholder="Learning Hours" value="{{ $listItem->learning_hours}}"></p>
                                    </textarea></p>
                                    <button class="button button5 w3-black w3-round" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            @endforeach


        </table>
    </div>
    <footer class="w3-footer w3-center w3-black">My Tutor @ WONG</footer>

    <div id="newitem" class="w3-modal w3-animate-opacity">
        <div class="w3-modal-content w3-round" style="width:500px">
            <header class="w3-row w3-black"> <span onclick="document.getElementById
     ('newitem').style.display='none'" class="button button5 w3-display-topright w3-small">&times;</span>
                <h4 class="w3-margin-left">New Subject Form</h4>
            </header>
            <div class="w3-padding">
                <form method="post" action="{{route('savesubject')}}">
                    {{csrf_field()}}
                    <p><input class="w3-input w3-round w3-border" type="text" name="sbid" placeholder="Code"></p>
                    <p><input class="w3-input w3-round w3-border" type="text" name="sbname" placeholder="Name"></p>
                    <p><input class="w3-input w3-round w3-border" type="text" name="sbdes" placeholder="Description">
                    </p>
                    <p><input class="w3-input w3-round w3-border" type="number" name="sbprice" placeholder="Price"
                            step="any"></p>
                    <p><input class="w3-input w3-round w3-border" type="text" name="sblh" placeholder="Learning Hours">
                    </p>
                    </textarea></p>
                    <button class="button button5 w3-round" type="submit">Insert</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>