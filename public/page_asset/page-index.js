var IndexViewModel = function(data) {
    var self = this;

    self.Tours = ko.observableArray(data.Tours || [])
    self.Drivers = ko.observableArray(data.Drivers || [])
    self.Banners = ko.observableArray(data.Banners || [])
    self.Cars = ko.observableArray(data.Cars || [])

    self.ImagePath = ko.observable(data.API_URLs.ImagePath || null);
    self.PublicPath = ko.observable(data.API_URLs.PublicPath || null);

    self.formatMoney = function(number) {
        var val = parseInt(number);
        return val.toFixed(0).replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
        }) + " VNĐ";
    };

    self.detailTourViewModel = new DetailTourViewModel(null);
    self.detailTourViewModel = ko.observable(null);

    self.viewDetailTour = function(data) {
        self.detailTourViewModel(new DetailTourViewModel(data));
        $('#detailTourModal').modal('toggle');

    }
}

var DetailTourViewModel = function(data) {
    var self = this;
    self.title = ko.observable(data ? data.title : '');
    self.description = ko.observable(data ? data.description : '');
    self.price = ko.observable(data ? data.price : '');
}