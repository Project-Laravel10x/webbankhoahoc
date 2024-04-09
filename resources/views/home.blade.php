{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Pusher Test</title>--}}
{{--    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>--}}
{{--    <script>--}}
{{--        Pusher.logToConsole = true;--}}

{{--        var pusher = new Pusher('461b56c9257844d091f5', {--}}
{{--            cluster: 'ap1'--}}
{{--        });--}}
{{--        console.log(1231)--}}
{{--        var channel = pusher.subscribe('my-channel');--}}
{{--        channel.bind('form-submit', function (data) {--}}
{{--            var newData = data.new; // Giả sử new là thông tin của giáo viên--}}
{{--            console.log(newData)--}}
{{--            // Tạo một thẻ li mới để hiển thị thông báo--}}
{{--            var notificationItem = '<li class="notification-message">' +--}}
{{--                '<div class="media d-flex">' +--}}
{{--                '<div>' +--}}
{{--                '<a href="notifications.html" class="avatar">' +--}}
{{--                '<img class="avatar-img" src="' + newData.thumbnail + '" alt="' + newData.name + '">' +--}}
{{--                '</a>' +--}}
{{--                '</div>' +--}}
{{--                '<div class="media-body">' +--}}
{{--                '<h6><a href="notifications.html">' + newData.name + ' requested <span>access to</span> Vừa đăng bởi: '+ newData.teacher_id +' </a></h6>' +--}}
{{--                '<button class="btn btn-accept">Accept</button>' +--}}
{{--                '<button class="btn btn-reject">Reject</button>' +--}}
{{--                '<p>' + newData.date + '</p>' +--}}
{{--                '</div>' +--}}
{{--                '</div>' +--}}
{{--                '</li>';--}}

{{--            // Thêm thông báo mới vào danh sách thông báo--}}
{{--            document.querySelector('.notification-list').innerHTML = notificationItem + document.querySelector('.notification-list').innerHTML;--}}
{{--        });--}}
{{--    </script>--}}
{{--</head>--}}
{{--<body>--}}
{{--<h1>Pusher Test</h1>--}}
{{--<p>--}}
{{--<ul class="notification-list"></ul>--}}
{{--Try publishing an event to channel <code>my-channel</code>--}}
{{--with event name <code>form-submit</code>.--}}
{{--</p>--}}
{{--</body>--}}
{{--</html>--}}
