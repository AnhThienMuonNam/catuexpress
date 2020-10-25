function FormViewModel(data) {
    var self = this;
    self.Cities = ko.observableArray(data.Cities || []);

    self.userModel = new UserModel(self, data);
    self.NotifyErrors = ko.observable(null);

    self.editUser = function() {
        self.NotifyErrors('');

        let model = self.userModel.toJSON();

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('#_token').val()
            }
        });

        $.ajax({
            url: data.API_URLs.EditUser,
            beforeSend: function() {
                NProgress.set(0.75);
            },
            type: "POST",
            data: model,
            success: function(response) {
                if (response.IsSuccess == true) {
                    alertify.success('Cập nhật thành công');
                }
            },
            error: function(xhr, error) {
                // alert("Something went wrong :(")
            },
            complete: function() {
                NProgress.done();
            },
        });
    };
}

var UserModel = function(parent, viewData) {
    var self = this;
    self.id = ko.observable(viewData.User.id);
    self.name = ko.observable(viewData.User.name);
    self.email = ko.observable(viewData.User.email);
    self.is_admin = ko.observable(viewData.User.is_admin == 1 ? true : false);


    UserModel.prototype.toJSON = function() {
        return {
            id: ko.utils.unwrapObservable(this.id),
            name: ko.utils.unwrapObservable(this.name),
            email: ko.utils.unwrapObservable(this.email),
            is_admin: ko.utils.unwrapObservable(this.is_admin() == true ? 1 : 0)
        }
    }
}