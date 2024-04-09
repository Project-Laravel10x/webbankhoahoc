var pusher = new Pusher('461b56c9257844d091f5', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('my-channel');
channel.bind('notification', function (data) {

    var notificationType = data.type;
    var newData = data.data;

    var createdAtDate = new Date(newData.created_at);
    var formattedDate = createdAtDate.toLocaleString('vi-VN');

    if (notificationType === 'notification-new') {
        var notificationItem = `

        <li class="notification-message">
            <div class="media d-flex">
                <div>
                    <a href="notifications.html" class="avatar">
                        <img  class="avatar-img" src="${newData.thumbnail}" alt="${newData.name}">
                    </a>
                </div>
                <div class="media-body">
                    <h6>Bài viết: ${newData.name}</h6>
                    <p class="mt-1 mb-1">Vừa đăng bởi: ${newData.teacher}</p>
                    <a href="tin-tuc/${newData.slug}" class="btn btn-accept">Xem bài viết ngay</a>
                    <p>Ngày đăng: ${formattedDate}</p>
                </div>
            </div>
        </li>
    `;

        var notificationList = document.querySelector('.notification-list');
        if (notificationList) {
            notificationList.innerHTML = notificationItem + notificationList.innerHTML;
        }
    } else if (notificationType === 'notification-course') {
        var notificationItem = `

        <li class="notification-message">
            <div class="media d-flex">
                <div>
                    <a href="notifications.html" class="avatar">
                        <img  class="avatar-img" src="${newData.thumbnail}" alt="${newData.name}">
                    </a>
                </div>
                <div class="media-body">
                    <h6>Khóa học: ${newData.name}</h6>
                    <p class="mt-1 mb-1">Được dạy bởi: ${newData.teacher}</p>
                    <a href="khoa-hoc/${newData.slug}" class="btn btn-accept">Xem khóa học ngay</a>
                    <p>Ngày đăng: ${formattedDate}</p>
                </div>
            </div>
        </li>
    `;

        var notificationList = document.querySelector('.notification-list');
        if (notificationList) {
            notificationList.innerHTML = notificationItem + notificationList.innerHTML;
        }
    }
});
