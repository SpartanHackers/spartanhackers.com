$(function () {

  $('#memberForm').on('submit', function (e) {

    e.preventDefault();

    $.ajax({
      type: 'post',
      url: 'database/checkMembership.php',
      data: $('form').serialize(),
      success: function (result) {
        if (result == "Welcome back member!") {
            alert(result); //all set
            $("#email").val("");
        } else if (result == "new"){
            //need more info
            $('#newMember').show();
        } else {
          //debugging only
          console.log(result);
        }
        console.log(result);
      }
    });
  });

  $('#newMemberForm').on('submit', function (e) {

    e.preventDefault();

    $.ajax({
      type: 'post',
      url: 'database/newMember.php',
      data: $('form').serialize(),
      success: function (result) {
        //console.log(result);
        alert("Welcome new member!");
        $("#email").val("");
        $("#first").val("");
        $("#last").val("");
        $("#major").val("");
        $("#grad").val("");
        $('#newMember').hide();
      }
    });
  });
});