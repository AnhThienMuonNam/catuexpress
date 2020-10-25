function FormViewModel(data) {
    var self = this;
    self.userModel = new UserModel(self, data);
    self.NotifyErrors = ko.observable(null);

    self.createUser = function(redirectToCreateOrder) {
        self.NotifyErrors('');
        let model = self.userModel.toJSON();

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('#_token').val()
            }
        });

        $.ajax({
            url: data.API_URLs.CreateUser,
            beforeSend: function() {
                NProgress.set(0.75);
            },
            type: "POST",
            data: model,
            success: function(response) {
                if (response.IsSuccess == true) {
                    alertify.success('Thêm thành công');
                    location.reload();
                }
            },
            error: function(xhr, error) {
                let responseJSON = xhr.responseJSON;
                let commaKey = '';

                for (var key in responseJSON) {
                    if (responseJSON.hasOwnProperty(key)) {
                        self.NotifyErrors(self.NotifyErrors() + commaKey + responseJSON[key][0]);
                        commaKey = ', ';
                    }
                }
            },
            complete: function() {
                NProgress.done();
            }
        });
    };
}

var UserModel = function(parent, viewData) {
    var self = this;
    self.id = ko.observable('');
    self.name = ko.observable('');
    self.email = ko.observable('');
    self.is_admin = ko.observable(false);
    self.password = ko.observable('Welcome@catuexpress');

    UserModel.prototype.toJSON = function() {
        return {
            id: ko.utils.unwrapObservable(this.id),
            name: ko.utils.unwrapObservable(this.name),
            email: ko.utils.unwrapObservable(this.email),
            password: ko.utils.unwrapObservable(this.password),
            is_admin: ko.utils.unwrapObservable(this.is_admin() == true ? 1 : 0)
        }
    }
}