@if(count($allequipments) > 0)
    <div class="row mt-30">
        <?php $count = 0; ?>
        @foreach($allequipments as $equip)
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-10">
                <div class="rentalbg">
                    <div class="row">
                        <input type="hidden" name="equipment_name[{{$count}}]"
                               value="{{$equip->name}}">
                        <input type="hidden" name="equipment_price[{{$count}}]"
                               value="{{$equip->price}}">
                        <div class="col-lg-3 pr-0">
                            <img src="https://www.swotahtravel.com/images/equipments/thumbnail/{{$equip->image}}"
                                 height="60px" alt="" width="100%">
                        <!-- <img src="{{url('images/equipments/thumbnail/'.$equip->image)}}"
                                                        height="60px" alt="" width="100%"> -->
                        </div>
                        <div class="col-lg-6 pr-0 eqname" id="eqname{{$equip->id}}"
                             style="margin-top: 5%; font-weight: 500;">{{$equip->name}}</div>
                        <div class="col-lg-3 pr-0">&nbsp;$<span
                                    id="eqprice{{$equip->id}}"
                                    style="font-size:13px;line-height:47px">{{$equip->price}}</span>
                        </div>
                        <div class="col-lg-12">

                            <div class="numberbox">
                                <button type="button" class="value-button" id="decrease"
                                        onclick="downequip({{$equip->id}})" value="Decrease Value">-
                                </button>
                                <input type="text" id="count{{$equip->id}}"
                                       readonly
                                       name="equipment_quantity[{{$count}}]"
                                       class="counter{{$equip->id}}" value="0" readonly
                                       autocomplete="off" value="0"
                                       style="width: 40px; text-align: center; color: black"
                                      />
                                <button type='button' class="value-button" id="increase"
                                        onclick="upequip({{$equip->id}})" value="Increase Value">+
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $count++ ?>
        @endforeach
    </div>
@endif
@if(count($extrapackages) > 0)


    <div class="inner-package-head-title mb-20"><h3>Optional Activities</h3></div>
    <div class="row mt-30">
        <?php $count1 = 0; ?>
        @foreach($extrapackages as $extrapackage)
            <input type="hidden" name="activity_name[{{$count1}}]" value="{{$extrapackage->title}}">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-10">
                <div class="optional-image">
                    <img src="https://www.swotahtravel.com/images/trips/extraPackages/thumbnail/{{$extrapackage->image}}">
                <!-- <img src="{{url('images/trips/extraPackages/thumbnail/'.$extrapackage->image)}}"> -->
                    <input type="hidden" id="actprice{{$extrapackage->id}}"
                           name="actprice[{{$count1}}]" value="{{$extrapackage->price}}">
                    <div class="optional-price">
                        <span>USD ${{$extrapackage->price}}</span>
                    </div>
                    <div class="optional-name">
                        <h1 id="actname{{$extrapackage->id}}">{{$extrapackage->title}}</h1>
                    </div>

                </div>
                <div class="optional-counter">
                    <button type="button" class="value-button" id="decrease"
                            onclick="downoptact({{$extrapackage->id}})"
                            value="Decrease Value">-
                    </button>
                    <input type="text" id="count1{{$extrapackage->id}}"
                           name="optact_number[{{$count1}}]"
                            class="counter1{{$extrapackage->id}}" value="0"
                           style="width: 40px; text-align: center; color: black"
                           readonly
                           autocomplete="off"/>
                    <button type='button' class="value-button" id="increase"
                            onclick="upoptact({{$extrapackage->id}})"
                            value="Increase Value">+
                    </button>
                </div>
            </div><?php $count1++ ?>
        @endforeach
    </div>
@endif
