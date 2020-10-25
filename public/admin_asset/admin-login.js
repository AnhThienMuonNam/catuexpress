function FormViewModel(data) {
    var self = this;

    self.Password = ko.observable(null);
    self.OTPCode = ko.observable(null);
    self.Email = ko.observable(null);
    self.ErrorNotify = ko.observable(null);
    self.SuccessNotify = ko.observable(null);


    self.getOTP = function() {
       $.ajaxSetup({
            headers: {'X-CSRF-Token': $('#_token').val()}
        });
        $.ajax({
            url: data.API_URLs.GetOTP,
            type: "POST",
            data: {
                    Email : self.Email()
                    },
            success: function(response){
              self.ErrorNotify('');
              self.SuccessNotify('');
                if(response.IsSuccess == true){
                  self.SuccessNotify('Mã xác thực đã được gửi vào email của bạn');
                }else{
                  self.ErrorNotify("Địa chỉ email của bạn không đúng");
                }
            },
            error: function(xhr, error){
                console.log(xhr.responseText);
                // alert("Something went wrong :(")
            },
        });
    };

    self.Login = function() {
       $.ajaxSetup({
            headers: {'X-CSRF-Token': $('#_token').val()}
        });
        $.ajax({
            url: data.API_URLs.Login,
            type: "POST",
            data: {
                    Email : self.Email(),
                    Password : self.Password()
                   // OTPCode : self.OTPCode()
                    },
            success: function(response){
              self.ErrorNotify('');
              self.SuccessNotify('');
                if(response.IsSuccess == true){
                  location.reload();
                }else{
                  self.ErrorNotify("Đăng nhập không thành công");
                }
            },
            error: function(xhr, error){
                console.log(xhr.responseText);
                // alert("Something went wrong :(")
            },
        });
    };


}
