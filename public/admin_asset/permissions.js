function FormViewModel(data) {
    var self = this;
    self.NotifyErrors = ko.observable(null);
    self.Permissions = ko.observableArray([]);

    self.savePermissions = function () {
        self.NotifyErrors('');
        let model = ko.toJS(this.Permissions)
        let active_permissions = model.filter(x => x.is_active == true).map(y => y.id);

        $.ajaxSetup({
            headers: { 'X-CSRF-Token': $('#_token').val() }
        });
        $.ajax({
            url: data.API_URLs.EditPermission,
            beforeSend: function () {
                NProgress.start();
            },
            type: "POST",
            data: { active_permissions },
            success: function (data) {
                if (data.IsSuccess == true) {
                    alertify.success('Cập nhật thành công');
                }
            },
            error: function (xhr, error) {
                let responseJSON = xhr.responseJSON;
                let commaKey = '';
                for (var key in responseJSON) {
                    if (responseJSON.hasOwnProperty(key)) {
                        self.NotifyErrors(self.NotifyErrors() + commaKey + responseJSON[key][0]);
                        commaKey = ', ';
                    }
                }
            },
            complete: function () {
                NProgress.done();
            },
        });
    }

    function init() {
        for (let i = 0; i < data.Permissions.length; i++) {
            let model = new PermissionModel(data.Permissions[i]);
            self.Permissions.push(model);
        }
    }

    init();
}

var PermissionModel = function (viewData) {
    var self = this;
    self.id = ko.observable(viewData.id);
    self.code = ko.observable(viewData.code);
    self.name = ko.observable(viewData.name);
    self.is_active = ko.observable(viewData.is_active == 1 ? true : false);
}
