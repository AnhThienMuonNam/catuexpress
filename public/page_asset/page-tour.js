function FormViewModel(data) {
    var self = this;
    self.ImagePath = ko.observable(data.API_URLs.ImagePath || null);
    self.PublicPath = ko.observable(data.API_URLs.PublicPath || null);

    self.Blogs = ko.observableArray(data.Blogs || [])
    self.OldBlogs = ko.observableArray(data.OldBlogs || [])
    self.PopularPosts = ko.observableArray(data.PopularPosts || [])

    self.Keyword = ko.observable(null);
}
