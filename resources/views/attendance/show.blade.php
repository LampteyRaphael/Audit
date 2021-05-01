<table>
                        <thead>
                        <tr>
                            <th>{{$localName}} Assembly</th>
                        </tr>
                        <tr>
                            <th>Category</th>
                            @foreach($post as $item)
                                <th>{{$item->created_at? Carbon\Carbon::parse($item->created_at)->format('jS F,Y'):'-'}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Ministers</th>
                            @if($post)
                                @foreach($post as $item)
                                    <td>{{$el=$item->ministers? $item->ministers:'-'}}</td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <th>Elders</th>
                            @if($post)
                                @foreach($post as $item)
                                    <td>{{$el=$item->elders? $item->elders:'-'}}</td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <th>Deacon</th>
                            @foreach($post as $item)
                                <td>{{$dac=$item->deacon? $item->deacon:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Deaconess</th>
                            @foreach($post as $item)
                                <td>{{$deacn=$item->deaconess? $item->deaconess:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Male</th>
                            @foreach($post as $item)
                                <td>{{$males=$item->male? $item->male:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Female</th>
                            @foreach($post as $item)
                                <td>{{$females=$item->female? $item->female:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Children</th>
                            @foreach($post as $item)
                                <td>{{$item->children? $item->children:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Visitors</th>
                            @foreach($post as $item)
                                <td>{{$v=$item->visitors? $item->visitors:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Total</th>
                            @foreach($post as $item)
                                <?php $ministers=$item->ministers?>
                                <?php $el=$item->elders?>
                                <?php $dea=$item->deacon?>
                                <?php $deacns=$item->deaconess?>
                                <?php $males=$item->male?>
                                <?php $females=$item->female?>
                                <?php $child=$item->children?>
                                <?php $visitors=$item->visitors?>
                                <td>{{$el+$dea+$deacns+$males+$females+$visitors+$child+$ministers}}</td>
                            @endforeach

                        </tr>


                        </tbody>
                    </table>
