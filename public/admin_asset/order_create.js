var FormViewModel = function(data) {
    var self = this;

    self.orderModel = new OrderModel(self, data);
    self.ImagePath = ko.observable(data.API_URLs.ImagePath || null);

    self.saveOrder = function() {
        let model = self.orderModel.toJSON();
        debugger;
        $.ajaxSetup({
            headers: { 'X-CSRF-Token': $('#_token').val() }
        });
        $.ajax({
            url: data.API_URLs.CreateOrder,
            beforeSend: function() {
                NProgress.start();
            },
            type: "POST",
            data: model,
            success: function(data) {
                if (data.IsSuccess == true) {
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
            },
        });
    };

    self.hasErrors = ko.observable(false);
    self.showErrorValidations = function() {
        var errors = ko.validation.group(self);
        if (errors().length > 0) {
            errors.showAllMessages(true);
            self.hasErrors(true);
        } else {
            self.hasErrors(false);
        }
    };

    self.formatMoney = function(number) {
        var val = parseInt(number);
        return val.toFixed(0).replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
        }) + "(đ)";
    };
}

var OrderModel = function(parent, viewData) {
    var self = this;

    self.banners = ko.observableArray([]);

    OrderModel.prototype.toJSON = function() {
        return {
            banners: ko.toJS(this.banners)
        };
    };

    self.addOrderDetail = function() {
        let newOrderDetail = new OrderDetailModel(self, viewData);

        self.banners.push(newOrderDetail);
    };

    self.removeOrderDetail = function(item) {
        self.banners.remove(item);
    };
}

var OrderDetailModel = function(parent, viewData) {
    var self = this;
    self.title = ko.observable('');
    self.image = ko.observable('');

    self.uploadImages = function(e, event) {
        var file_data = $(event.target).prop('files')[0];
        var form_data = new FormData();
        form_data.append('uploadFile', file_data);
        $.ajaxSetup({
            headers: { 'X-CSRF-Token': $('#_token').val() }
        });

        $.ajax({
            url: viewData.API_URLs.UploadImage,
            beforeSend: function() {
                NProgress.set(0.75);
            },
            type: "POST",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                self.image(res);
                $(event.target).val("");
            },
            error: function(xhr, error) {},
            complete: function() {
                NProgress.done();
            },
        });
    };

}