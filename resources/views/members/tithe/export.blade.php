                        <table>
                            <thead>
                            <tr>
                                <th style="font-size: 16px;text-transform: uppercase;">Year:{{$year}}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="font-size: 16px;text-transform: uppercase;">{{$localName}}</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="font-size: 15px;text-transform: uppercase;">{{$name1}}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="font-size: 15px;text-transform: uppercase;">{{$name2}}</th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>WEEK 1</th>
                                <th>WEEK 2</th>
                                <th>WEEK 3</th>
                                <th>WEEK 4</th>
                                <th>WEEK 5</th>
                                <th>TOTAL</th>

                                <th>WEEK 1</th>
                                <th>WEEK 2</th>
                                <th>WEEK 3</th>
                                <th>WEEK 4</th>
                                <th>WEEK 5</th>
                                <th>TOTAL</th>
                            </tr>
                            </thead>
                            <tbody>
                        &nbsp;&nbsp;
                                @if($users)
                                    @foreach($users as $user_id)
                                        <tr>
                                            <td>{{$user_id->members_id}}</td>

                                            {{--january--}}
                                            <td>


                                                @if (number_format(
                                                    App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                    ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                      ->skip(0)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                    ->skip(0)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif

                                            </td>
                                            <td>
                                                @if (   number_format(
                                                 App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                 ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                   ->skip(1)->take(1)
                                               ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                    ->skip(1)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>

                                            <td>
                                                @if (   number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                              ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                ->skip(2)->take(1)
                                            ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                    ->skip(2)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (   number_format(
                                           App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                           ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                             ->skip(3)->take(1)
                                         ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                    ->skip(3)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (   number_format(
                                            App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                            ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                              ->skip(4)->take(1)
                                          ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                    ->skip(4)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>

                                            <td>

                                                @if ( number_format(
                                      App\PostTithe::where('user_id', $user_id->id)
                                          ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                          ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)

                                                @else
                                                    {{
                                             number_format(
                                      App\PostTithe::where('user_id', $user_id->id)
                                          ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                          ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                             }}
                                                @endif


                                            </td>


                                            {{--February--}}
                                            <td>
                                                @if (   number_format(
                                                    App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                    ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                      ->skip(0)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                    ->skip(0)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif

                                            </td>
                                            <td>
                                                @if (   number_format(
                                                 App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                 ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                   ->skip(1)->take(1)
                                               ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                    ->skip(1)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>

                                            <td>
                                                @if (   number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                              ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                ->skip(2)->take(1)
                                            ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                    ->skip(2)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (   number_format(
                                           App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                           ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                             ->skip(3)->take(1)
                                         ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                    ->skip(3)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (   number_format(
                                            App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                            ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                              ->skip(4)->take(1)
                                          ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                    ->skip(4)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>

                                            <td>

                                                @if ( number_format(
                                      App\PostTithe::where('user_id', $user_id->id)
                                          ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                          ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)

                                                @else
                                                    {{
                                             number_format(
                                      App\PostTithe::where('user_id', $user_id->id)
                                          ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                          ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                             }}
                                                @endif


                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

