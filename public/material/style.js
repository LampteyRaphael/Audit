$(document).ready(function(){
    $("#editUser").on('show.bs.modal', function (event) {
        var button= $(event.relatedTarget)
        var mobileNumber1=button.data('mobile')
        var mobileNumber2=button.data('mobile2')
        var email=button.data('e_mail')
        var digitalA=button.data('digital')
        var houseaddress=button.data('houseaddress')
        var streetname=button.data('streetname')
        var landmark=button.data('landmark')
        var workNumber=button.data('workNumber')
        var whatsappNumber=button.data('whatsappNumber')
        var education=button.data('education')
        var courseStud=button.data('course')
        var employment=button.data('employment')
        var pOccupation=button.data('occupation')
        var placeOfWork=button.data('work')
        var movement=button.data('movement')
        var positions=button.data('positions')
        var datejoinchurchs=button.data('datejoinchurch')
        var denominations=button.data('denomination')
        var baptisms=button.data('baptism')
        var baptismby=button.data('baptismby')
        var baptismdate=button.data('baptismdate')
        var baptismlocality=button.data('baptismlocality')
        var fellowship=button.data('fellowship')
        var communicants=button.data('communicants')
        var spiritbaptism=button.data('spiritbaptism')
        var anyspiritualgift=button.data('anyspiritualgift')
        var pleaseindicate=button.data('pleaseindicate')
        var office=button.data('office')
        var images=button.data('photo')
        var uname=button.data('username')
        var gen=button.data('genders');
        var birth=button.data('birth')
        var placeofbirths=button.data('placeofbirth')
        var hometowns=button.data('hometown')
        var hometown_regions=button.data('hometownregion')
        var nationalitys=button.data('nationality')
        var language=button.data('lang')
        var maritalstatus=button.data('maritalstatu')
        var mariagetyp=button.data('marriagetypes')
        var spouseNam=button.data('spousename')
        var numberOfChildre=button.data('numberchildren')
        var fathers_nam=button.data('fathersname')
        var fathers_hometow=button.data('fathershometown')
        var mothers_nam=button.data('mothersname')
        var mothers_hometow=button.data('mothershometown')
        var  isactive=button.data('isactive')
        var  role=button.data('roleid')
        var  mids=button.data('membersid')
        var str = mids.toString();
        var res = str.substr(6, 9);
        var usersid=button.data('ids');



        var modal=$(this)
        modal.find('.modal-title').text('EDIT MEMBERSHIP DATA')
        modal.find('.modal-body  #userid').val(usersid);
        modal.find('.modal-body  #mobileNumber1').val(mobileNumber1);
        modal.find('.modal-body  #mobileNumber2').val(mobileNumber2);
        modal.find('.modal-body  #email').val(email);
        modal.find('.modal-body  #digitalAddress').val(digitalA);
        modal.find('.modal-body  #houseaddress').val(houseaddress);
        modal.find('.modal-body  #streetname').val(streetname);
        modal.find('.modal-body  #landmark').val(landmark);
        modal.find('.modal-body  #workNumber').val(workNumber);
        modal.find('.modal-body  #whatsappNumber').val(whatsappNumber);
        modal.find('.modal-body  #education').val(education);
        modal.find('.modal-body  #courseStudied').val(courseStud);
        modal.find('.modal-body  #employmentType').val(employment);
        modal.find('.modal-body  #profOccupation').val(pOccupation);
        modal.find('.modal-body  #placeOfWork').val(placeOfWork);
        modal.find('.modal-body  #movementGroup').val(movement);
        modal.find('.modal-body  #position').val(positions);
        modal.find('.modal-body  #datejoinchurch').val(datejoinchurchs);
        modal.find('.modal-body  #previousdenomination').val(denominations);
        modal.find('.modal-body  #waterBaptism').val(baptisms);
        modal.find('.modal-body  #baptismBy').val(baptismby);
        modal.find('.modal-body  #baptismdate').val(baptismdate);
        modal.find('.modal-body  #baptismLocality').val(baptismlocality);
        modal.find('.modal-body  #rightHandOfFellowship').val(fellowship);
        modal.find('.modal-body  #communicant').val(communicants);
        modal.find('.modal-body  #holySpiritBaptism').val(spiritbaptism);
        modal.find('.modal-body  #anySpiritualGift').val(anyspiritualgift);
        modal.find('.modal-body  #pleaseIndicate').val(pleaseindicate);
        modal.find('.modal-body  #officeHeld').val(office);
        modal.find('.modal-body  #myImage').attr('src', images);
        modal.find('.modal-body  #name').val(uname);
        modal.find('.modal-body  #gender').val(gen);
        modal.find('.modal-body  #birthDate').val(birth);
        modal.find('.modal-body  #placeOfBirth').val(placeofbirths);
        modal.find('.modal-body  #hometown').val(hometowns);
        modal.find('.modal-body  #hometown_region').val(hometown_regions);
        modal.find('.modal-body  #nationality').val(nationalitys);
        modal.find('.modal-body  #languagess').val(language);
        modal.find('.modal-body  #maritalStatus').val(maritalstatus);
        modal.find('.modal-body  #mariagetype').val(mariagetyp);
        modal.find('.modal-body  #spouseName').val(spouseNam);
        modal.find('.modal-body  #numberOfChildren').val(numberOfChildre);
        modal.find('.modal-body  #fathers_name').val(fathers_nam);
        modal.find('.modal-body  #fathers_hometown').val(fathers_hometow);
        modal.find('.modal-body  #mothers_name').val(mothers_nam);
        modal.find('.modal-body  #mothers_hometown').val(mothers_hometow);
        modal.find('.modal-body  #is_active').val(isactive);
        modal.find('.modal-body  #role_id').val(role);
        modal.find('.modal-body  #members_id').val(res);

    });
});

$(document).ready(function () {
    $("#deposit").on('show.bs.modal', function (event) {
        var button= $(event.relatedTarget)
        var categoryId=button.data('categorys')
        var categorynames=button.data('categoryname')
        var modal=$(this)
        modal.find('.modal-title').text(categorynames);
        modal.find('.modal-body  #categoruId').val(categoryId);
    });
});


$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.deleteButton').click(function (e) {
        e.preventDefault();
        var buttonid= $(this).closest('tr').find('.userID').val()

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert the data!",
            type:  'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.value) {
                var data={
                    "_token":$('input[name=_token]').val(),
                    "id":buttonid,
                }
                $.ajax({
                    type:"DELETE",
                    url :'registration/'+buttonid,
                    data:data,
                    success:function (response) {
                        Swal({
                            type: "success",
                            title:response.success1,
                            showConfirmButton: true,
                            position:'top-end',
                            timer: 3000,
                        })
                        .then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        })
    });
});


$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.deleteCategory').click(function (e) {
        e.preventDefault();
        var buttonid= $(this).closest('tr').find('.cID').val()

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert the data!",
            type:  'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.value) {
                var data={
                    "_token":$('input[name=_token]').val(),
                    "id":buttonid,
                }
                $.ajax({
                    type:"DELETE",
                    url :'/income/category/'+buttonid,
                    data:data,
                    success:function (response) {
                        Swal({
                            type: "success",
                            title:response.success1,
                            showConfirmButton: true,
                            position:'top-end',
                            timer: 3000,
                        })
                            .then((result) => {
                                location.reload();
                            });
                    }
                });
            }
        })
    });
});

$(document).ready(function() {
    var showsupdate= $('.showsupdate').val();

        if (showsupdate ==null) return false;
        if (showsupdate !== "") {
            Swal.fire({
                type: 'success',
                title: showsupdate,
                showConfirmButton: true,
              },);
            return false
        }

});


function ConfirmUpdate(){
     var x = confirm("Are you sure you want to update?");
     if (x)
         return true;
     else
         return false;

 }



$(document).ready(function(){
    $(".detailsButton").on('show.bs.modal', function (event) {
        var button= $(event.relatedTarget)
        var mobileNumber1=button.data('mobile')
        var mobileNumber2=button.data('mobile2')
        var email=button.data('e_mail')
        var digitalA=button.data('digital')
        var houseaddress=button.data('houseaddress')
        var streetname=button.data('streetname')
        var landmark=button.data('landmark')
        var workNumber=button.data('workNumber')
        var whatsappNumber=button.data('whatsappNumber')
        var education=button.data('education')
        var courseStud=button.data('course')
        var employment=button.data('employment')
        var pOccupation=button.data('occupation')
        var placeOfWork=button.data('work')
        var movement=button.data('movement')
        var positions=button.data('positions')
        var datejoinchurchs=button.data('datejoinchurch')
        var denominations=button.data('denomination')
        var baptisms=button.data('baptism')
        var baptismby=button.data('baptismby')
        var baptismdate=button.data('baptismdate')
        var baptismlocality=button.data('baptismlocality')
        var fellowship=button.data('fellowship')
        var communicants=button.data('communicants')
        var spiritbaptism=button.data('spiritbaptism')
        var anyspiritualgift=button.data('anyspiritualgift')
        var pleaseindicate=button.data('pleaseindicate')
        var office=button.data('office')
        var images=button.data('photo')
        var uname=button.data('username')
        var gen=button.data('genders');
        var birth=button.data('birth')
        var placeofbirths=button.data('placeofbirth')
        var hometowns=button.data('hometown')
        var hometown_regions=button.data('hometownregion')
        var nationalitys=button.data('nationality')
        var language=button.data('lang')
        var maritalstatus=button.data('maritalstatu')
        var mariagetyp=button.data('marriagetypes')
        var spouseNam=button.data('spousename')
        var numberOfChildre=button.data('numberchildren')
        var fathers_nam=button.data('fathersname')
        var fathers_hometow=button.data('fathershometown')
        var mothers_nam=button.data('mothersname')
        var mothers_hometow=button.data('mothershometown')
        var  isactive=button.data('isactive')
        var  role=button.data('roleid')
        var  mids=button.data('membersid')
        var str = mids.toString();
        var res = str.substr(6, 9);
        var usersid=button.data('ids');


        var modal=$(this)
        modal.find('.modal-title').text('EDIT MEMBERSHIP DATA')
        modal.find('.modal-body  #userid').val(usersid);
        modal.find('.modal-body  #mobileNumber1').val(mobileNumber1);
        modal.find('.modal-body  #mobileNumber2').val(mobileNumber2);
        modal.find('.modal-body  #email').val(email);
        modal.find('.modal-body  #digitalAddress').val(digitalA);
        modal.find('.modal-body  #houseaddress').val(houseaddress);
        modal.find('.modal-body  #streetname').val(streetname);
        modal.find('.modal-body  #landmark').val(landmark);
        modal.find('.modal-body  #workNumber').val(workNumber);
        modal.find('.modal-body  #whatsappNumber').val(whatsappNumber);
        modal.find('.modal-body  #education').val(education);
        modal.find('.modal-body  #courseStudied').val(courseStud);
        modal.find('.modal-body  #employmentType').val(employment);
        modal.find('.modal-body  #profOccupation').val(pOccupation);
        modal.find('.modal-body  #placeOfWork').val(placeOfWork);
        modal.find('.modal-body  #movementGroup').val(movement);
        modal.find('.modal-body  #position').val(positions);
        modal.find('.modal-body  #datejoinchurch').val(datejoinchurchs);
        modal.find('.modal-body  #previousdenomination').val(denominations);
        modal.find('.modal-body  #waterBaptism').val(baptisms);
        modal.find('.modal-body  #baptismBy').val(baptismby);
        modal.find('.modal-body  #baptismdate').val(baptismdate);
        modal.find('.modal-body  #baptismLocality').val(baptismlocality);
        modal.find('.modal-body  #rightHandOfFellowship').val(fellowship);
        modal.find('.modal-body  #communicant').val(communicants);
        modal.find('.modal-body  #holySpiritBaptism').val(spiritbaptism);
        modal.find('.modal-body  #anySpiritualGift').val(anyspiritualgift);
        modal.find('.modal-body  #pleaseIndicate').val(pleaseindicate);
        modal.find('.modal-body  #officeHeld').val(office);
        modal.find('.modal-body  #myImage').attr('src', images);
        modal.find('.modal-body  #name').val(uname);
        modal.find('.modal-body  #gender').val(gen);
        modal.find('.modal-body  #birthDate').val(birth);
        modal.find('.modal-body  #placeOfBirth').val(placeofbirths);
        modal.find('.modal-body  #hometown').val(hometowns);
        modal.find('.modal-body  #hometown_region').val(hometown_regions);
        modal.find('.modal-body  #nationality').val(nationalitys);
        modal.find('.modal-body  #languagess').val(language);
        modal.find('.modal-body  #maritalStatus').val(maritalstatus);
        modal.find('.modal-body  #mariagetype').val(mariagetyp);
        modal.find('.modal-body  #spouseName').val(spouseNam);
        modal.find('.modal-body  #numberOfChildren').val(numberOfChildre);
        modal.find('.modal-body  #fathers_name').val(fathers_nam);
        modal.find('.modal-body  #fathers_hometown').val(fathers_hometow);
        modal.find('.modal-body  #mothers_name').val(mothers_nam);
        modal.find('.modal-body  #mothers_hometown').val(mothers_hometow);
        modal.find('.modal-body  #is_active').val(isactive);
        modal.find('.modal-body  #role_id').val(role);
        modal.find('.modal-body  #members_id').val(res);
    });
});





