<?php

require_once('Language.php');

class en_us extends Language
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    protected function _LoadDates()
    {
        $dates = [];

        $dates['general_date'] = 'd/m/Y'; // Ngày/Tháng/Năm
        $dates['general_datetime'] = 'd/m/Y H:i:s'; // Ngày/Tháng/Năm Giờ:Phút:Giây
        $dates['short_datetime'] = 'd/m/y H:i'; // Ngày/Tháng/Năm ngắn Giờ:Phút
        $dates['schedule_daily'] = 'l, d/m/Y'; // Thứ, Ngày/Tháng/Năm
        $dates['reservation_email'] = 'd/m/Y @ H:i (e)'; // Ngày/Tháng/Năm @ Giờ:Phút (Múi giờ)
        $dates['res_popup'] = 'D, d/m H:i'; // Thứ, Ngày/Tháng Giờ:Phút
        $dates['res_popup_time'] = 'H:i'; // Giờ:Phút
        $dates['short_reservation_date'] = 'd/m/y H:i'; // Ngày/Tháng/Năm ngắn Giờ:Phút
        $dates['dashboard'] = 'D, d/m/Y H:i'; // Thứ, Ngày/Tháng/Năm Giờ:Phút
        $dates['period_time'] = 'H:i'; // Giờ:Phút
        $dates['timepicker'] = 'HH:mm'; // Giờ:Phút (định dạng 24h)
        $dates['mobile_reservation_date'] = 'd/m H:i'; // Ngày/Tháng Giờ:Phút
        $dates['general_date_js'] = 'dd/mm/yy'; // Ngày/Tháng/Năm (JS)
        $dates['general_time_js'] = 'HH:mm'; // Giờ:Phút (JS)
        $dates['timepicker_js'] = 'HH:mm'; // Giờ:Phút (JS)
        $dates['momentjs_datetime'] = 'D/M/YY HH:mm'; // Ngày/Tháng/Năm Giờ:Phút (Moment.js)
        $dates['calendar_time'] = 'H:mm'; // Giờ:Phút (Lịch)
        $dates['calendar_dates'] = 'M d'; // Tháng Ngày (Lịch)
        $dates['embedded_date'] = 'D d'; // Thứ Ngày (Hiển thị lồng ghép)
        $dates['embedded_time'] = 'H:i'; // Giờ:Phút (Hiển thị lồng ghép)
        $dates['embedded_datetime'] = 'd/m H:i'; // Ngày/Tháng Giờ:Phút (Hiển thị lồng ghép)
        $dates['report_date'] = '%d/%m'; // Ngày/Tháng (Báo cáo)    
        $this->Dates = $dates;

        return $this->Dates;
    }

    /**
     * @return array
     */
    protected function _LoadStrings()
    {
        $strings = [];

        $strings['FirstName'] = 'Tên';
        $strings['LastName'] = 'Họ';
        $strings['Timezone'] = 'Múi giờ';
        $strings['Edit'] = 'Chỉnh sửa';
        $strings['Change'] = 'Thay đổi';
        $strings['Rename'] = 'Đổi tên';
        $strings['Remove'] = 'Xóa';
        $strings['Delete'] = 'Xóa';
        $strings['Update'] = 'Cập nhật';
        $strings['Cancel'] = 'Hủy';
        $strings['Add'] = 'Thêm';
        $strings['Name'] = 'Tên';
        $strings['Yes'] = 'Có';
        $strings['No'] = 'Không';
        $strings['FirstNameRequired'] = 'Tên là bắt buộc.';
        $strings['LastNameRequired'] = 'Họ là bắt buộc.';
        $strings['PwMustMatch'] = 'Xác nhận mật khẩu phải khớp với mật khẩu.';
        $strings['ValidEmailRequired'] = 'Địa chỉ email hợp lệ là bắt buộc.';
        $strings['UniqueEmailRequired'] = 'Địa chỉ email đó đã được đăng ký.';
        $strings['UniqueUsernameRequired'] = 'Tên người dùng đó đã được đăng ký.';
        $strings['UserNameRequired'] = 'Tên người dùng là bắt buộc.';
        $strings['CaptchaMustMatch'] = 'Captcha là bắt buộc.';
        $strings['Today'] = 'Hôm nay';
        $strings['Week'] = 'Tuần';
        $strings['Month'] = 'Tháng';
        $strings['BackToCalendar'] = 'Quay lại lịch';
        $strings['BeginDate'] = 'Bắt đầu';
        $strings['EndDate'] = 'Kết thúc';
        $strings['Username'] = 'Tên người dùng';
        $strings['Password'] = 'Mật khẩu';
        $strings['PasswordConfirmation'] = 'Xác nhận mật khẩu';
        $strings['DefaultPage'] = 'Trang chủ mặc định';
        $strings['MyCalendar'] = 'Lịch của tôi';
        $strings['ScheduleCalendar'] = 'Lịch lịch trình';
        $strings['Registration'] = 'Đăng ký';
        $strings['NoAnnouncements'] = 'Không có thông báo nào';
        $strings['Announcements'] = 'Thông báo';
        $strings['NoUpcomingReservations'] = 'Bạn không có đặt chỗ sắp tới';
        $strings['UpcomingReservations'] = 'Đặt chỗ sắp tới';
        $strings['AllNoUpcomingReservations'] = 'Không có đặt chỗ sắp tới trong %s ngày tới';
        $strings['AllUpcomingReservations'] = 'Tất cả đặt chỗ sắp tới';
        $strings['ShowHide'] = 'Hiện/Ẩn';
        $strings['Error'] = 'Lỗi';
        $strings['ReturnToPreviousPage'] = 'Quay lại trang trước đó';
        $strings['UnknownError'] = 'Lỗi không xác định';
        $strings['InsufficientPermissionsError'] = 'Bạn không có quyền truy cập tài nguyên này';
        $strings['MissingReservationResourceError'] = 'Chưa chọn tài nguyên';
        $strings['MissingReservationScheduleError'] = 'Chưa chọn lịch trình';
        $strings['DoesNotRepeat'] = 'Không lặp lại';
        $strings['Daily'] = 'Hàng ngày';
        $strings['Weekly'] = 'Hàng tuần';
        $strings['Monthly'] = 'Hàng tháng';
        $strings['Yearly'] = 'Hàng năm';
        $strings['RepeatPrompt'] = 'Lặp lại';
        $strings['hours'] = 'giờ';
        $strings['days'] = 'ngày';
        $strings['weeks'] = 'tuần';
        $strings['months'] = 'tháng';
        $strings['years'] = 'năm';
        $strings['day'] = 'ngày';
        $strings['week'] = 'tuần';
        $strings['month'] = 'tháng';
        $strings['year'] = 'năm';
        $strings['repeatDayOfMonth'] = 'ngày trong tháng';
        $strings['repeatDayOfWeek'] = 'ngày trong tuần';
        $strings['RepeatUntilPrompt'] = 'Đến khi';
        $strings['RepeatEveryPrompt'] = 'Mỗi';
        $strings['RepeatDaysPrompt'] = 'Vào';
        $strings['CreateReservationHeading'] = 'Đặt chỗ mới';
        $strings['EditReservationHeading'] = 'Chỉnh sửa đặt chỗ %s';
        $strings['ViewReservationHeading'] = 'Xem đặt chỗ %s';
        $strings['ReservationErrors'] = 'Thay đổi đặt chỗ';
        $strings['Create'] = 'Tạo';
        $strings['ThisInstance'] = 'Chỉ trường hợp này';
        $strings['AllInstances'] = 'Tất cả các trường hợp';
        $strings['FutureInstances'] = 'Các trường hợp trong tương lai';
        $strings['Print'] = 'In';
        $strings['ShowHideNavigation'] = 'Hiện/Ẩn Điều hướng';
        $strings['ReferenceNumber'] = 'Số tham chiếu';
        $strings['Tomorrow'] = 'Ngày mai';
        $strings['LaterThisWeek'] = 'Cuối tuần này';
        $strings['NextWeek'] = 'Tuần tới';
        $strings['SignOut'] = 'Đăng xuất';
        $strings['LayoutDescription'] = 'Bắt đầu vào %s, hiển thị %s ngày mỗi lần';
        $strings['AllResources'] = 'Tất cả tài nguyên';
        $strings['TakeOffline'] = 'Ngắt kết nối';
        $strings['BringOnline'] = 'Kết nối lại';
        $strings['AddImage'] = 'Thêm hình ảnh';
        $strings['NoImage'] = 'Chưa có hình ảnh';
        $strings['Move'] = 'Di chuyển';
        $strings['AppearsOn'] = 'Xuất hiện vào %s';
        $strings['Location'] = 'Địa điểm';
        $strings['NoLocationLabel'] = '(chưa đặt địa điểm)';
        $strings['Contact'] = 'Liên hệ';
        $strings['NoContactLabel'] = '(chưa có thông tin liên hệ)';
        $strings['Description'] = 'Mô tả';
        $strings['NoDescriptionLabel'] = '(chưa có mô tả)';
        $strings['Notes'] = 'Ghi chú';
        $strings['NoNotesLabel'] = '(chưa có ghi chú)';
        $strings['NoTitleLabel'] = '(chưa có tiêu đề)';
        $strings['UsageConfiguration'] = 'Cấu hình sử dụng';
        $strings['ChangeConfiguration'] = 'Thay đổi cấu hình';
        $strings['ResourceMinLength'] = 'Đặt chỗ phải kéo dài ít nhất %s';
        $strings['ResourceMinLengthNone'] = 'Không có thời gian đặt chỗ tối thiểu';
        $strings['ResourceMaxLength'] = 'Đặt chỗ không được kéo dài quá %s';
        $strings['ResourceMaxLengthNone'] = 'Không có thời gian đặt chỗ tối đa';
        $strings['ResourceRequiresApproval'] = 'Đặt chỗ phải được phê duyệt';
        $strings['ResourceRequiresApprovalNone'] = 'Đặt chỗ không cần phê duyệt';
        $strings['ResourcePermissionAutoGranted'] = 'Quyền được cấp tự động';
        $strings['ResourcePermissionNotAutoGranted'] = 'Quyền không được cấp tự động';
        $strings['ResourceMinNotice'] = 'Đặt chỗ phải được thực hiện ít nhất %s trước thời gian bắt đầu';
        $strings['ResourceMinNoticeNone'] = 'Đặt chỗ có thể được thực hiện cho đến thời điểm hiện tại';
        $strings['ResourceMinNoticeUpdate'] = 'Đặt chỗ phải được cập nhật ít nhất %s trước thời gian bắt đầu';
        $strings['ResourceMinNoticeNoneUpdate'] = 'Đặt chỗ có thể được cập nhật cho đến thời điểm hiện tại';
        $strings['ResourceMinNoticeDelete'] = 'Đặt chỗ phải được xóa ít nhất %s trước thời gian bắt đầu';
        $strings['ResourceMinNoticeNoneDelete'] = 'Đặt chỗ có thể được xóa cho đến thời điểm hiện tại';
        $strings['ResourceMaxNotice'] = 'Đặt chỗ không được kết thúc quá %s so với thời điểm hiện tại';
        $strings['ResourceMaxNoticeNone'] = 'Đặt chỗ có thể kết thúc vào bất kỳ thời điểm nào trong tương lai';
        $strings['ResourceBufferTime'] = 'Phải có khoảng cách %s giữa các đặt chỗ';
        $strings['ResourceBufferTimeNone'] = 'Không có khoảng cách giữa các đặt chỗ';
        $strings['ResourceAllowMultiDay'] = 'Đặt chỗ có thể được thực hiện qua nhiều ngày';
        $strings['ResourceNotAllowMultiDay'] = 'Đặt chỗ không thể được thực hiện qua nhiều ngày';
        $strings['ResourceCapacity'] = 'This resource has a capacity of %s people';
        $strings['ResourceCapacityNone'] = 'This resource has unlimited capacity';
        $strings['AddNewResource'] = 'Thêm tài nguyên mới';
        $strings['AddNewUser'] = 'Thêm người dùng mới';
        $strings['AddResource'] = 'Thêm tài nguyên';
        $strings['Capacity'] = 'Sức chứa';
        $strings['Access'] = 'Truy cập';
        $strings['Duration'] = 'Thời lượng';
        $strings['Active'] = 'Hoạt động';
        $strings['Inactive'] = 'Không hoạt động';
        $strings['ResetPassword'] = 'Đặt lại mật khẩu';
        $strings['LastLogin'] = 'Lần đăng nhập cuối';
        $strings['Search'] = 'Tìm kiếm';
        $strings['ResourcePermissions'] = 'Quyền tài nguyên';
        $strings['Reservations'] = 'Đặt chỗ';
        $strings['Groups'] = 'Nhóm';
        $strings['Users'] = 'Người dùng';
        $strings['AllUsers'] = 'Tất cả người dùng';
        $strings['AllGroups'] = 'Tất cả nhóm';
        $strings['AllSchedules'] = 'Tất cả lịch';
        $strings['UsernameOrEmail'] = 'Tên người dùng hoặc Email';
        $strings['Members'] = 'Thành viên';
        $strings['QuickSlotCreation'] = 'Tạo các khe mỗi %s phút giữa %s và %s';
        $strings['ApplyUpdatesTo'] = 'Áp dụng cập nhật cho';
        $strings['CancelParticipation'] = 'Hủy tham gia';
        $strings['Attending'] = 'Tham dự';
        $strings['QuotaConfiguration'] = 'Vào %s cho %s người dùng trong %s bị giới hạn ở %s %s mỗi %s';
        $strings['QuotaEnforcement'] = 'Thực thi %s %s';
        $strings['reservations'] = 'đặt chỗ';
        $strings['reservation'] = 'đặt chỗ';
        $strings['ChangeCalendar'] = 'Thay đổi lịch';
        $strings['AddQuota'] = 'Thêm hạn ngạch';
        $strings['FindUser'] = 'Tìm người dùng';
        $strings['Created'] = 'Đã tạo';
        $strings['LastModified'] = 'Lần sửa cuối';
        $strings['GroupName'] = 'Tên nhóm';
        $strings['GroupMembers'] = 'Thành viên nhóm';
        $strings['GroupRoles'] = 'Vai trò nhóm';
        $strings['GroupAdmin'] = 'Quản trị viên nhóm';
        $strings['Actions'] = 'Hành động';
        $strings['CurrentPassword'] = 'Mật khẩu hiện tại';
        $strings['NewPassword'] = 'Mật khẩu mới';
        $strings['InvalidPassword'] = 'Mật khẩu hiện tại không đúng';
        $strings['PasswordChangedSuccessfully'] = 'Mật khẩu của bạn đã được thay đổi thành công';
        $strings['SignedInAs'] = 'Đăng nhập với tư cách';
        $strings['NotSignedIn'] = 'Bạn chưa đăng nhập';
        $strings['ReservationTitle'] = 'Tiêu đề đặt chỗ';
        $strings['ReservationDescription'] = 'Mô tả đặt chỗ';
        $strings['ResourceList'] = 'Tài nguyên để đặt chỗ';
        $strings['Accessories'] = 'Phụ kiện';
        $strings['InvitationList'] = 'Danh sách mời';
        $strings['AccessoryName'] = 'Tên phụ kiện';
        $strings['QuantityAvailable'] = 'Số lượng có sẵn';
        $strings['Resources'] = 'Tài nguyên';
        $strings['Participants'] = 'Người tham gia';
        $strings['User'] = 'Người dùng';
        $strings['Resource'] = 'Tài nguyên';
        $strings['Status'] = 'Trạng thái';
        $strings['Approve'] = 'Phê duyệt';
        $strings['Page'] = 'Trang';
        $strings['Rows'] = 'Hàng';
        $strings['Unlimited'] = 'Không giới hạn';
        $strings['Email'] = 'Email';
        $strings['EmailAddress'] = 'Địa chỉ Email';
        $strings['Phone'] = 'Số điện thoại';
        $strings['Organization'] = 'Tổ chức';
        $strings['Position'] = 'Chức vụ';
        $strings['Language'] = 'Ngôn ngữ';
        $strings['Permissions'] = 'Quyền';
        $strings['Reset'] = 'Đặt lại';
        $strings['FindGroup'] = 'Tìm nhóm';
        $strings['Manage'] = 'Quản lý';
        $strings['None'] = 'Không có';
        $strings['AddToOutlook'] = 'Thêm vào Lịch Outlook';
        $strings['Done'] = 'Hoàn thành';
        $strings['RememberMe'] = 'Ghi nhớ đăng nhập';
        $strings['FirstTimeUser?'] = 'Người dùng lần đầu?';
        $strings['CreateAnAccount'] = 'Tạo tài khoản';
        $strings['ViewSchedule'] = 'Xem lịch trình  ';
        $strings['ForgotMyPassword'] = 'Tôi quên mật khẩu';
        $strings['YouWillBeEmailedANewPassword'] = 'Bạn sẽ nhận được một mật khẩu mới được tạo ngẫu nhiên qua email';
        $strings['Close'] = 'Đóng';
        $strings['ExportToCSV'] = 'Xuất ra CSV';
        $strings['OK'] = 'OK';
        $strings['Working'] = 'Đang xử lý...';
        $strings['Login'] = 'Đăng nhập';
        $strings['AdditionalInformation'] = 'Thông tin bổ sung';
        $strings['AllFieldsAreRequired'] = 'tất cả các trường đều bắt buộc';
        $strings['Optional'] = 'tùy chọn';
        $strings['YourProfileWasUpdated'] = 'Hồ sơ của bạn đã được cập nhật';
        $strings['YourSettingsWereUpdated'] = 'Cài đặt của bạn đã được cập nhật';
        $strings['Register'] = 'Đăng ký';
        $strings['SecurityCode'] = 'Mã bảo mật';
        $strings['ReservationCreatedPreference'] = 'When I create a reservation or a reservation is created on my behalf';
        $strings['ReservationUpdatedPreference'] = 'When I update a reservation or a reservation is updated on my behalf';
        $strings['ReservationDeletedPreference'] = 'When I delete a reservation or a reservation is deleted on my behalf';
        $strings['ReservationApprovalPreference'] = 'When my pending reservation is approved';
        $strings['PreferenceSendEmail'] = 'Xem thông báo qua email';
        $strings['PreferenceNoEmail'] = 'Không thông báo cho tôi qua email';
        $strings['ReservationCreated'] = 'Your reservation was successfully created!';
        $strings['ReservationUpdated'] = 'Your reservation was successfully updated!';
        $strings['ReservationRemoved'] = 'Your reservation was removed';
        $strings['ReservationRequiresApproval'] = 'One or more of the resources reserved require approval before usage.  This reservation will be pending until it is approved.';
        $strings['YourReferenceNumber'] = 'Your reference number is %s';
        $strings['ChangeUser'] = 'Thay đổi người dùng';
        $strings['MoreResources'] = 'Nhiều tài nguyên hơn';
        $strings['ReservationLength'] = 'Thời lượng đặt chỗ';
        $strings['ParticipantList'] = 'Danh sách người tham gia';
        $strings['AddParticipants'] = 'Thêm người tham gia';
        $strings['InviteOthers'] = 'Mời người khác tham gia đặt chỗ này';
        $strings['AddResources'] = 'Thêm tài nguyên';
        $strings['AddAccessories'] = 'Thêm phụ kiện';
        $strings['Accessory'] = 'Phụ kiện';
        $strings['QuantityRequested'] = 'Số lượng yêu cầu';
        $strings['CreatingReservation'] = 'Đang tạo đặt chỗ';
        $strings['UpdatingReservation'] = 'Đang cập nhật đặt chỗ';
        $strings['DeleteWarning'] = 'Hành động này là vĩnh viễn và không thể hoàn tác!';
        $strings['DeleteAccessoryWarning'] = 'Xóa phụ kiện này sẽ loại bỏ nó khỏi tất cả các đặt chỗ.';
        $strings['AddAccessory'] = 'Thêm phụ kiện';
        $strings['AddBlackout'] = 'Thêm thời gian chặn';
        $strings['AllResourcesOn'] = 'Tất cả tài nguyên bật';
        $strings['Reason'] = 'Lý do';
        $strings['BlackoutShowMe'] = 'Hiển thị các đặt chỗ xung đột';
        $strings['BlackoutDeleteConflicts'] = 'Xóa các đặt chỗ xung đột';
        $strings['Filter'] = 'Bộ lọc';
        $strings['Between'] = 'Giữa';
        $strings['CreatedBy'] = 'Được tạo bởi';
        $strings['BlackoutCreated'] = 'Thời gian chặn đã được tạo';
        $strings['BlackoutNotCreated'] = 'Không thể tạo thời gian chặn';
        $strings['BlackoutUpdated'] = 'Thời gian chặn đã được cập nhật';
        $strings['BlackoutNotUpdated'] = 'Không thể cập nhật thời gian chặn';
        $strings['BlackoutConflicts'] = 'Có các thời gian chặn xung đột';
        $strings['ReservationConflicts'] = 'Có các thời gian đặt chỗ xung đột';
        $strings['UsersInGroup'] = 'Người dùng trong nhóm này';
        $strings['Browse'] = 'Duyệt';
        $strings['DeleteGroupWarning'] = 'Xóa nhóm này sẽ xóa tất cả các quyền tài nguyên liên quan. Người dùng trong nhóm này có thể mất quyền truy cập vào tài nguyên.';
        $strings['WhatRolesApplyToThisGroup'] = 'Vai trò nào áp dụng cho nhóm này?';
        $strings['WhoCanManageThisGroup'] = 'Ai có thể quản lý nhóm này?';
        $strings['WhoCanManageThisSchedule'] = 'Ai có thể quản lý lịch này?';
        $strings['AllQuotas'] = 'Tất cả hạn ngạch';
        $strings['QuotaReminder'] = 'Nhớ: Hạn ngạch được thực thi dựa trên múi giờ của lịch.';
        $strings['AllReservations'] = 'Tất cả đặt chỗ';
        $strings['PendingReservations'] = 'Đặt chỗ đang chờ xử lý';
        $strings['Approving'] = 'Đang phê duyệt';
        $strings['MoveToSchedule'] = 'Chuyển đến lịch';
        $strings['DeleteResourceWarning'] = 'Xóa tài nguyên này sẽ xóa tất cả dữ liệu liên quan, bao gồm';
        $strings['DeleteResourceWarningReservations'] = 'tất cả các đặt chỗ trong quá khứ, hiện tại và tương lai liên quan đến nó';
        $strings['DeleteResourceWarningPermissions'] = 'tất cả các quyền được gán';
        $strings['DeleteResourceWarningReassign'] = 'Vui lòng gán lại bất cứ thứ gì bạn không muốn bị xóa trước khi tiếp tục';
        $strings['ScheduleLayout'] = 'Bố cục (tất cả thời gian %s)';
        $strings['ReservableTimeSlots'] = 'Khoảng thời gian có thể đặt';
        $strings['BlockedTimeSlots'] = 'Khoảng thời gian bị chặn';
        $strings['ThisIsTheDefaultSchedule'] = 'Đây là lịch mặc định';
        $strings['DefaultScheduleCannotBeDeleted'] = 'Lịch mặc định không thể bị xóa';
        $strings['MakeDefault'] = 'Đặt làm mặc định';
        $strings['BringDown'] = 'Hạ xuống';
        $strings['ChangeLayout'] = 'Thay đổi bố cục';
        $strings['AddSchedule'] = 'Thêm lịch';
        $strings['StartsOn'] = 'Bắt đầu vào';
        $strings['NumberOfDaysVisible'] = 'Số ngày hiển thị';
        $strings['UseSameLayoutAs'] = 'Sử dụng cùng bố cục với';
        $strings['Format'] = 'Định dạng';
        $strings['OptionalLabel'] = 'Nhãn tùy chọn';
        $strings['LayoutInstructions'] = 'Nhập một khoảng thời gian mỗi dòng. Các khoảng thời gian phải được cung cấp cho tất cả 24 giờ trong ngày bắt đầu và kết thúc vào lúc 12:00 AM.';
        $strings['AddUser'] = 'Thêm người dùng';
        $strings['UserPermissionInfo'] = 'Quyền truy cập thực tế vào tài nguyên có thể khác nhau tùy thuộc vào vai trò người dùng, quyền nhóm hoặc cài đặt quyền bên ngoài';
        $strings['DeleteUserWarning'] = 'Xóa người dùng này sẽ xóa tất cả các đặt chỗ hiện tại, tương lai và lịch sử của họ.';
        $strings['AddAnnouncement'] = 'Thêm thông báo';
        $strings['Announcement'] = 'Thông báo';
        $strings['Priority'] = 'Ưu tiên';
        $strings['Reservable'] = 'Mở';
        $strings['Unreservable'] = 'Bị chặn';
        $strings['Reserved'] = 'Đã đặt';
        $strings['MyReservation'] = 'Đặt chỗ của tôi';
        $strings['Pending'] = 'Đang chờ xử lý';
        $strings['Past'] = 'Quá khứ';
        $strings['Restricted'] = 'Bị hạn chế';
        $strings['ViewAll'] = 'Xem tất cả';
        $strings['MoveResourcesAndReservations'] = 'Chuyển tài nguyên và đặt chỗ đến';
        $strings['TurnOffSubscription'] = 'Ẩn khỏi công chúng';
        $strings['TurnOnSubscription'] = 'Hiển thị cho công chúng (RSS, iCalendar, Máy tính bảng, Màn hình)';
        $strings['SubscribeToCalendar'] = 'Đăng ký lịch này';
        $strings['SubscriptionsAreDisabled'] = 'Quản trị viên đã tắt đăng ký lịch';
        $strings['NoResourceAdministratorLabel'] = '(Không có Quản trị viên Tài nguyên)';
        $strings['WhoCanManageThisResource'] = 'Ai có thể quản lý Tài nguyên này?';
        $strings['ResourceAdministrator'] = 'Quản trị viên Tài nguyên';
        $strings['Private'] = 'Riêng tư';
        $strings['Accept'] = 'Cho phép';
        $strings['Decline'] = 'Từ chối';
        $strings['ShowFullWeek'] = 'Hiển thị toàn bộ tuần';
        $strings['CustomAttributes'] = 'Thuộc tính tùy chỉnh';
        $strings['AddAttribute'] = 'Thêm thuộc tính';
        $strings['EditAttribute'] = 'Cập nhật thuộc tính';
        $strings['DisplayLabel'] = 'Hiện thị nhãn';
        $strings['Type'] = 'Loại';
        $strings['Required'] = 'Bắt buộc';
        $strings['ValidationExpression'] = 'Biểu thức xác thực';
        $strings['PossibleValues'] = 'Giá trị có thể';
        $strings['SingleLineTextbox'] = 'Hộp văn bản một dòng';
        $strings['MultiLineTextbox'] = 'Hộp văn bản nhiều dòng';
        $strings['Checkbox'] = 'Hộp kiểm';
        $strings['SelectList'] = 'Danh sách chọn';
        $strings['CommaSeparated'] = 'phân tách bằng dấu phẩy';
        $strings['Category'] = 'Danh mục';
        $strings['CategoryReservation'] = 'Đặt chỗ';
        $strings['CategoryGroup'] = 'Nhóm';
        $strings['SortOrder'] = 'Thứ tự sắp xếp';
        $strings['Title'] = 'Tiêu đề';
        $strings['AdditionalAttributes'] = 'Thuộc tính bổ sung';
        $strings['True'] = 'True';
        $strings['False'] = 'False';
        $strings['ForgotPasswordEmailSent'] = 'Email đã được gửi đến địa chỉ được cung cấp với hướng dẫn đặt lại mật khẩu của bạn';
        $strings['ActivationEmailSent'] = 'Bạn sẽ sớm nhận được email kích hoạt.';
        $strings['AccountActivationError'] = 'Xin lỗi, chúng tôi không thể kích hoạt tài khoản của bạn.';
        $strings['Attachments'] = 'Đính kèm';
        $strings['AttachFile'] = 'Đính kèm tệp';
        
        // Camera Feature
        $strings['CapturePhoto'] = 'Chụp hình';
        $strings['TakePhoto'] = 'Chụp hình';
        $strings['RetakePhoto'] = 'Chụp lại';
        $strings['SwitchCamera'] = 'Switch camera';
        $strings['SavePhoto'] = 'Lưu hình';
        $strings['CameraTitle'] = 'Chụp hình từ camera';
        $strings['CameraAccessDenied'] = 'Không thể truy cập camera. Vui lòng kiểm tra quyền truy cập camera.';
        $strings['InvalidFileType'] = 'Loại tệp không hợp lệ. Chỉ cho phép: %s';
        // End Camera Feature
        
        // Zalo Notification
        $strings['ZaloNotification'] = 'Thông báo Zalo';
        $strings['SendZaloNotification'] = 'Gửi thông báo Zalo';
        $strings['NotifyCustomerCheckin'] = 'Thông báo khách vào';
        $strings['ZaloSendSuccess'] = 'Đã gửi thông báo Zalo thành công';
        $strings['ZaloSendFailed'] = 'Gửi thông báo Zalo thất bại';
        $strings['ZaloNotEnabled'] = 'Chức năng thông báo Zalo chưa được kích hoạt';
        $strings['ZaloSending'] = 'Đang gửi thông báo Zalo...';
        $strings['ZaloCustomerCheckedIn'] = 'Khách đã check-in';
        $strings['CustomerCheckin'] = 'Khách vào';
        $strings['CustomerCheckout'] = 'Khách ra';
        
        // Zalo Admin Config
        $strings['ZaloConfiguration'] = 'Cấu hình Zalo';
        $strings['ManageZalo'] = 'Quản lý Zalo';
        $strings['GeneralSettings'] = 'Cài đặt chung';
        $strings['EnableZaloNotifications'] = 'Bật thông báo Zalo';
        $strings['EnableZaloNotificationsHelp'] = 'Kích hoạt tính năng gửi thông báo qua Zalo';
        $strings['RecipientType'] = 'Loại người nhận';
        $strings['RecipientTypeHelp'] = 'Chọn nhóm (Group) hoặc cá nhân (User)';
        $strings['RecipientID'] = 'ID người nhận';
        $strings['RecipientIDHelp'] = 'ID của nhóm hoặc người dùng nhận thông báo';
        $strings['SaveConfiguration'] = 'Lưu cấu hình';
        $strings['ConfigurationSavedSuccessfully'] = 'Đã lưu cấu hình thành công';
        $strings['FailedToSaveConfiguration'] = 'Lưu cấu hình thất bại';
        $strings['ErrorSavingConfiguration'] = 'Lỗi khi lưu cấu hình';
        $strings['ZaloLogin'] = 'Đăng nhập Zalo';
        $strings['CheckingLoginStatus'] = 'Đang kiểm tra trạng thái đăng nhập';
        $strings['NotLoggedIn'] = 'Chưa đăng nhập';
        $strings['ZaloLoggedIn'] = 'Đã đăng nhập Zalo thành công';
        $strings['ScanQRWithZalo'] = 'Quét mã QR bằng ứng dụng Zalo trên điện thoại';
        $strings['RefreshQRCode'] = 'Làm mới mã QR';
        $strings['QRCodeNotAvailable'] = 'Mã QR không khả dụng';
        $strings['FailedToLoadQRCode'] = 'Không thể tải mã QR';
        $strings['CannotConnectToZaloService'] = 'Không thể kết nối đến dịch vụ Zalo';
        $strings['HowToGetRecipientID'] = 'Cách lấy ID người nhận';
        $strings['ForGroup'] = 'Đối với nhóm';
        $strings['ForUser'] = 'Đối với cá nhân';
        $strings['ZaloGroupStep1'] = 'Mở Zalo Web: https://chat.zalo.me/';
        $strings['ZaloGroupStep2'] = 'Click vào nhóm muốn nhận thông báo';
        $strings['ZaloGroupStep3'] = 'Xem URL trên thanh địa chỉ, copy ID sau /group/';
        $strings['ZaloUserStep1'] = 'Mở Zalo Web: https://chat.zalo.me/';
        $strings['ZaloUserStep2'] = 'Click vào người dùng muốn nhận thông báo';
        $strings['ZaloUserStep3'] = 'Xem URL trên thanh địa chỉ, copy ID sau /u/';
        $strings['ImportantNotes'] = 'Lưu ý quan trọng';
        $strings['ZaloNote1'] = 'Chỉ một phiên Zalo Web có thể hoạt động cùng lúc';
        $strings['ZaloNote2'] = 'Không mở Zalo Web trên trình duyệt khi service đang chạy';
        $strings['ZaloNote3'] = 'Phiên đăng nhập có thể hết hạn sau vài ngày';
        $strings['ZaloNote4'] = 'Service cần chạy liên tục để duy trì kết nối';
        $strings['Saving'] = 'Đang lưu';
        $strings['Group'] = 'Nhóm';
        // Zalo Admin page (manage_zalo.tpl)
        $strings['ZaloApiUrl'] = 'URL API Zalo';
        $strings['ZaloApiUrlHelp'] = 'Địa chỉ endpoint của máy chủ Zalo API (Node.js) dùng để gửi tin nhắn.';
        $strings['ZaloApiKeyHelp'] = 'API key dùng để xác thực từ ứng dụng này tới máy chủ Zalo API.';
        $strings['ZaloDefaultUID'] = 'UID mặc định';
        $strings['ZaloDefaultUIDHelp'] = 'Danh sách UID người nhận mặc định, ngăn cách bằng dấu phẩy, sử dụng khi tài nguyên không có cấu hình riêng.';
        $strings['ZaloDefaultGroupID'] = 'Group ID mặc định';
        $strings['ZaloDefaultGroupIDHelp'] = 'Danh sách Group ID người nhận mặc định, ngăn cách bằng dấu phẩy, sử dụng khi tài nguyên không có cấu hình riêng.';
        $strings['ZaloSendImageWithNotification'] = 'Gửi thông báo kèm hình ảnh';
        $strings['ZaloSendImageWithNotificationHelp'] = 'Bật: gửi cả nội dung và ảnh chụp. Tắt: chỉ gửi nội dung (không kèm hình ảnh).';
        $strings['ZaloPerResourceJson'] = 'Cấu hình từng tài nguyên (JSON)';
        $strings['ZaloPerResourceJsonFormat'] = 'Định dạng:';
        $strings['ZaloPerResourceJsonHelp'] = 'Key là ResourceId (ví dụ trường ẩn #primaryResourceId trên form đặt chỗ).';
        // End Zalo Notification
        
        $strings['Maximum'] = 'tối đa';
        $strings['NoScheduleAdministratorLabel'] = 'Chưa có quản trị viên lịch';
        $strings['ScheduleAdministrator'] = 'Quản trị viên lịch';
        $strings['Total'] = 'Tổng cộng';
        $strings['QuantityReserved'] = 'Số lượng đã đặt';
        $strings['AllAccessories'] = 'Tất cả phụ kiện';
        $strings['GetReport'] = 'Lấy báo cáo';
        $strings['NoResultsFound'] = 'Không tìm thấy kết quả phù hợp';
        $strings['SaveThisReport'] = 'Lưu báo cáo này';
        $strings['ReportSaved'] = 'Báo cáo đã được lưu!';
        $strings['EmailReport'] = 'Gửi báo cáo qua email';
        $strings['ReportSent'] = 'Báo cáo đã được gửi!';
        $strings['RunReport'] = 'Chạy báo cáo';
        $strings['NoSavedReports'] = 'Bạn không có báo cáo đã lưu nào.';
        $strings['CurrentWeek'] = 'Tuần hiện tại';
        $strings['CurrentMonth'] = 'Tháng hiện tại';
        $strings['AllTime'] = 'Tất cả thời gian';
        $strings['FilterBy'] = 'Lọc theo';
        $strings['Select'] = 'Chọn';
        $strings['List'] = 'Danh sách';
        $strings['TotalTime'] = 'Thời gian';
        $strings['Count'] = 'Số lượng';
        $strings['Usage'] = 'Sử dụng';
        $strings['AggregateBy'] = 'Tổng hợp theo';
        $strings['Range'] = 'Khoảng';
        $strings['Choose'] = 'Chọn';
        $strings['All'] = 'Tất cả';
        $strings['ViewAsChart'] = 'Xem dưới dạng biểu đồ';
        $strings['ReservedResources'] = 'Tài nguyên đã đặt';
        $strings['ReservedAccessories'] = 'Phụ kiện đã đặt';
        $strings['ResourceUsageTimeBooked'] = 'Sử dụng tài nguyên - Thời gian đã đặt';
        $strings['ResourceUsageReservationCount'] = 'Sử dụng tài nguyên - Số lượng đặt chỗ';
        $strings['Top20UsersTimeBooked'] = 'Top 20 người dùng - Thời gian đã đặt';
        $strings['Top20UsersReservationCount'] = 'Top 20 người dùng - Số lượng đặt chỗ';
        $strings['ConfigurationUpdated'] = 'Tệp cấu hình đã được cập nhật';
        $strings['ConfigurationUiNotEnabled'] = 'Không thể truy cập trang này vì $conf[\'settings\'][\'pages\'][\'enable.configuration\'] được đặt thành false hoặc bị thiếu.';
        $strings['ConfigurationFileNotWritable'] = 'Tệp cấu hình không thể ghi được. Vui lòng kiểm tra quyền của tệp này và thử lại.';
        $strings['ConfigurationEnvWarning'] = 'Một số giá trị cấu hình đang bị ghi đè bởi biến môi trường hoặc tệp <code>.env</code> của bạn. Thay đổi chỉ có thể thực hiện nếu bạn xóa các biến môi trường tương ứng.';
        $strings['ConfigurationUpdateHelp'] = 'Tham khảo phần Cấu hình trong <a target=_blank href=%s class=link-primary>Tệp trợ giúp</a> để biết tài liệu về các cài đặt này.';
        $strings['GeneralConfigSettings'] = 'cài đặt';
        $strings['UseSameLayoutForAllDays'] = 'Sử dụng cùng bố cục cho tất cả các ngày';
        $strings['LayoutVariesByDay'] = 'Bố cục thay đổi theo ngày';
        $strings['ManageReminders'] = 'Nhắc nhở';
        $strings['ReminderUser'] = 'ID người dùng';
        $strings['ReminderMessage'] = 'Tin nhắn';
        $strings['ReminderAddress'] = 'Địa chỉ';
        $strings['ReminderSendtime'] = 'Thời gian gửi';
        $strings['ReminderRefNumber'] = 'Số tham chiếu đặt chỗ';
        $strings['ReminderSendtimeDate'] = 'Ngày nhắc nhở';
        $strings['ReminderSendtimeTime'] = 'Giờ nhắc nhở (HH:MM)';
        $strings['ReminderSendtimeAMPM'] = 'Sáng / Chiều';
        $strings['AddReminder'] = 'Thêm nhắc nhở';
        $strings['DeleteReminderWarning'] = 'Bạn có chắc chắn muốn xóa điều này không?';
        $strings['NoReminders'] = 'Bạn không có nhắc nhở sắp tới nào.';
        $strings['Reminders'] = 'Nhắc nhở';
        $strings['SendReminder'] = 'Gửi nhắc nhở';
        $strings['minutes'] = 'phút';
        $strings['hours'] = 'giờ';
        $strings['days'] = 'ngày';
        $strings['ReminderBeforeStart'] = 'trước thời gian bắt đầu';
        $strings['ReminderBeforeEnd'] = 'trước thời gian kết thúc';
        $strings['Logo'] = 'Logo';
        $strings['CssFile'] = 'Tệp CSS';
        $strings['ThemeUploadSuccess'] = 'Thay đổi của bạn đã được lưu. Làm mới trang để thay đổi có hiệu lực.';
        $strings['MakeDefaultSchedule'] = 'Đặt làm lịch mặc định của tôi';
        $strings['DefaultScheduleSet'] = 'Đây hiện là lịch mặc định của bạn';
        $strings['FlipSchedule'] = 'Lật bố cục lịch';
        $strings['Next'] = 'Tiếp theo';
        $strings['Success'] = 'Thành công';
        $strings['Participant'] = 'Người tham gia';
        $strings['ResourceFilter'] = 'Bộ lọc tài nguyên';
        $strings['ResourceGroups'] = 'Nhóm tài nguyên';
        $strings['AddNewGroup'] = 'Thêm nhóm mới';
        $strings['Quit'] = 'Thoát';
        $strings['AddGroup'] = 'Thêm nhóm';
        $strings['StandardScheduleDisplay'] = 'Sử dụng hiển thị lịch tiêu chuẩn';
        $strings['TallScheduleDisplay'] = 'Sử dụng hiển thị lịch cao';
        $strings['WideScheduleDisplay'] = 'Sử dụng hiển thị lịch rộng';
        $strings['CondensedWeekScheduleDisplay'] = 'Sử dụng hiển thị lịch tuần thu gọn';
        $strings['ResourceGroupHelp1'] = 'Kéo và thả nhóm tài nguyên để sắp xếp lại.';
        $strings['ResourceGroupHelp2'] = 'Nhấp chuột phải vào tên nhóm tài nguyên để có thêm hành động.';
        $strings['ResourceGroupHelp3'] = 'Kéo và thả tài nguyên để thêm chúng vào nhóm.';
        $strings['ResourceGroupWarning'] = 'Nếu sử dụng nhóm tài nguyên, mỗi tài nguyên phải được gán cho ít nhất một nhóm. Tài nguyên chưa được gán sẽ không thể được đặt.';
        $strings['ResourceType'] = 'Loại tài nguyên';
        $strings['AppliesTo'] = 'Áp dụng cho';
        $strings['UniquePerInstance'] = 'Duy nhất mỗi trường hợp';
        $strings['AddResourceType'] = 'Thêm loại tài nguyên';
        $strings['NoResourceTypeLabel'] = '(chưa đặt loại tài nguyên)';
        $strings['ClearFilter'] = 'Xóa bộ lọc';
        $strings['MinimumCapacity'] = 'Sức chứa tối thiểu';
        $strings['Color'] = 'Màu sắc';
        $strings['Available'] = 'Khả dụng';
        $strings['Unavailable'] = 'Không khả dụng';
        $strings['Hidden'] = 'Ẩn';
        $strings['ResourceStatus'] = 'Trạng thái tài nguyên';
        $strings['CurrentStatus'] = 'Trạng thái hiện tại';
        $strings['AllReservationResources'] = 'Tất cả tài nguyên đặt chỗ';
        $strings['File'] = 'Tệp';
        $strings['BulkResourceUpdate'] = 'Cập nhật tài nguyên hàng loạt';
        $strings['Unchanged'] = 'Không thay đổi';
        $strings['Common'] = 'Chung';
        $strings['AdminOnly'] = 'Chỉ quản trị viên';
        $strings['AdvancedFilter'] = 'Bộ lọc nâng cao';
        $strings['MinimumQuantity'] = 'Số lượng tối thiểu';
        $strings['MaximumQuantity'] = 'Số lượng tối đa';
        $strings['ChangeLanguage'] = 'Thay đổi ngôn ngữ';
        $strings['AddRule'] = 'Thêm quy tắc';
        $strings['Attribute'] = 'Thuộc tính';
        $strings['RequiredValue'] = 'Giá trị bắt buộc';
        $strings['ReservationCustomRuleAdd'] = 'Sử dụng màu này khi thuộc tính đặt chỗ được đặt thành giá trị sau';
        $strings['AddReservationColorRule'] = 'Thêm quy tắc màu đặt chỗ';
        $strings['LimitAttributeScope'] = 'Thu thập trong trường hợp cụ thể';
        $strings['CollectFor'] = 'Thu thập cho';
        $strings['SignIn'] = 'Đăng nhập';
        $strings['SignInWith'] = 'Đăng nhập với';
        $strings['AllParticipants'] = 'Tất cả người tham gia';
        $strings['RegisterANewAccount'] = 'Đăng ký tài khoản mới';
        $strings['Dates'] = 'Ngày';
        $strings['More'] = 'Thêm';
        $strings['ResourceAvailability'] = 'Tính khả dụng của tài nguyên';
        $strings['UnavailableAllDay'] = 'Không khả dụng cả ngày';
        $strings['AvailableUntil'] = 'Khả dụng đến';
        $strings['AvailableBeginningAt'] = 'Khả dụng bắt đầu từ';
        $strings['AvailableAt'] = 'Khả dụng lúc';
        $strings['AllResourceTypes'] = 'Tất cả loại tài nguyên';
        $strings['AllResourceStatuses'] = 'Tất cả trạng thái tài nguyên';
        $strings['AllowParticipantsToJoin'] = 'Cho phép người tham gia tham gia';
        $strings['Join'] = 'Tham gia';
        $strings['YouAreAParticipant'] = 'Bạn là người tham gia đặt chỗ này';
        $strings['YouAreInvited'] = 'Bạn được mời tham gia đặt chỗ này';
        $strings['YouCanJoinThisReservation'] = 'Bạn có thể tham gia đặt chỗ này';
        $strings['Import'] = 'Nhập';
        $strings['GetTemplate'] = 'Lấy mẫu';
        $strings['UserImportInstructions'] = '<ul><li>Tệp phải ở định dạng CSV.</li><li>Tên người dùng và email là trường bắt buộc.</li><li>Tính hợp lệ của thuộc tính sẽ không được thực thi.</li><li>Để trống các trường khác sẽ đặt giá trị mặc định và \'password\' làm mật khẩu của người dùng.</li><li>Sử dụng mẫu được cung cấp làm ví dụ.</li></ul>';
        $strings['RowsImported'] = 'Số hàng đã nhập';
        $strings['RowsSkipped'] = 'Số hàng đã bỏ qua';
        $strings['Columns'] = 'Cột';
        $strings['Reserve'] = 'Đặt chỗ';
        $strings['AllDay'] = 'Cả ngày';
        $strings['Everyday'] = 'Hàng ngày';
        $strings['IncludingCompletedReservations'] = 'Bao gồm đặt chỗ đã hoàn thành';
        $strings['NotCountingCompletedReservations'] = 'Không bao gồm đặt chỗ đã hoàn thành';
        $strings['RetrySkipConflicts'] = 'Bỏ qua đặt chỗ xung đột';
        $strings['Retry'] = 'Thử lại';
        $strings['RemoveExistingPermissions'] = 'Xóa quyền hiện có?';
        $strings['Continue'] = 'Tiếp tục';
        $strings['WeNeedYourEmailAddress'] = 'Chúng tôi cần địa chỉ email của bạn để đặt chỗ';
        $strings['ResourceColor'] = 'Màu tài nguyên';
        $strings['DateTime'] = 'Ngày giờ';
        $strings['AutoReleaseNotification'] = 'Tự động giải phóng nếu không check in trong vòng %s phút';
        $strings['RequiresCheckInNotification'] = 'Yêu cầu check in/out';
        $strings['NoCheckInRequiredNotification'] = 'Không yêu cầu check in/out';
        $strings['RequiresApproval'] = 'Yêu cầu phê duyệt';
        $strings['CheckingIn'] = 'Đang check in';
        $strings['CheckingOut'] = 'Đang check out';
        $strings['CheckIn'] = 'Check In';
        $strings['CheckOut'] = 'Check Out';
        $strings['ReleasedIn'] = 'Giải phóng trong';
        $strings['CheckedInSuccess'] = 'Bạn đã check in';
        $strings['CheckedOutSuccess'] = 'Bạn đã check out';
        $strings['CheckInFailed'] = 'Không thể check in';
        $strings['CheckOutFailed'] = 'Không thể check out';
        $strings['CheckInTime'] = 'Thời gian Check In';
        $strings['CheckOutTime'] = 'Thời gian Check Out';
        $strings['OriginalEndDate'] = 'Kết thúc ban đầu';
        $strings['SpecificDates'] = 'Hiển thị ngày cụ thể';
        $strings['Users'] = 'Người dùng';
        $strings['Guest'] = 'Khách';
        $strings['ResourceDisplayPrompt'] = 'Tài nguyên để hiển thị';
        $strings['Credits'] = 'Tín dụng';
        $strings['AvailableCredits'] = 'Tín dụng có sẵn';
        $strings['CreditUsagePerSlot'] = 'Yêu cầu %s tín dụng mỗi khe (ngoài giờ cao điểm)';
        $strings['PeakCreditUsagePerSlot'] = 'Yêu cầu %s tín dụng mỗi khe (giờ cao điểm)';
        $strings['CreditsRule'] = 'Bạn không có đủ tín dụng. Tín dụng yêu cầu: %s. Tín dụng trong tài khoản: %s';
        $strings['PeakTimes'] = 'Giờ cao điểm';
        $strings['AllYear'] = 'Cả năm';
        $strings['MoreOptions'] = 'Thêm tùy chọn';
        $strings['SendAsEmail'] = 'Gửi qua Email';
        $strings['UsersInGroups'] = 'Người dùng trong nhóm';
        $strings['UsersWithAccessToResources'] = 'Người dùng có quyền truy cập tài nguyên';
        $strings['AnnouncementSubject'] = 'Một thông báo mới đã được đăng bởi %s';
        $strings['AnnouncementEmailNotice'] = 'người dùng sẽ nhận được thông báo này qua email';
        $strings['Day'] = 'Ngày';
        $strings['NotifyWhenAvailable'] = 'Thông báo cho tôi khi khả dụng';
        $strings['AddingToWaitlist'] = 'Đang thêm bạn vào danh sách chờ';
        $strings['WaitlistRequestAdded'] = 'Bạn sẽ được thông báo nếu thời gian này trở nên khả dụng';
        $strings['PrintQRCode'] = 'In mã QR';
        $strings['FindATime'] = 'Tìm thời gian';
        $strings['AnyResource'] = 'Bất kỳ tài nguyên nào';
        $strings['ThisWeek'] = 'Tuần này';
        $strings['Hours'] = 'Giờ';
        $strings['Minutes'] = 'Phút';
        $strings['ImportICS'] = 'Nhập từ ICS';
        $strings['ImportQuartzy'] = 'Nhập từ Quartzy';
        $strings['OnlyIcs'] = 'Chỉ các tệp *.ics được phép tải lên.';
        $strings['IcsLocationsAsResources'] = 'Các địa điểm sẽ được nhập dưới dạng tài nguyên.';
        $strings['IcsMissingOrganizer'] = 'Bất kỳ sự kiện nào thiếu người tổ chức sẽ có chủ sở hữu được đặt thành người dùng hiện tại.';
        $strings['IcsWarning'] = 'Các quy tắc đặt chỗ sẽ không được thực thi - có thể xảy ra xung đột, trùng lặp, v.v.';
        $strings['BlackoutAroundConflicts'] = 'Chặn xung quanh các đặt chỗ xung đột';
        $strings['DuplicateReservation'] = 'Trùng lặp';
        $strings['UnavailableNow'] = 'Hiện không khả dụng';
        $strings['ReserveLater'] = 'Đặt chỗ sau';
        $strings['CollectedFor'] = 'Đã thu cho';
        $strings['IncludeDeleted'] = 'Bao gồm các đặt chỗ đã xóa';
        $strings['Deleted'] = 'Đã xóa';
        $strings['Back'] = 'Quay lại';
        $strings['Forward'] = 'Tiến lên';
        $strings['DateRange'] = 'Khoảng ngày';
        $strings['Copy'] = 'Sao chép';
        $strings['Detect'] = 'Phát hiện';
        $strings['Autofill'] = 'Tự động điền';
        $strings['NameOrEmail'] = 'tên hoặc email';
        $strings['ImportResources'] = 'Nhập tài nguyên';
        $strings['ExportResources'] = 'Xuất tài nguyên';
        $strings['ResourceImportInstructions'] = '<ul><li>File must be in CSV format with UTF-8 encoding.</li><li>Name is required field. Leaving other fields blank will set default values.</li><li>Status options are \'Available\', \'Unavailable\' and \'Hidden\'.</li><li>Color should be the hex value. ex) #ffffff.</li><li>Auto assign and approval columns can be true or false.</li><li>Attribute validity will not be enforced.</li><li>Comma separate multiple resource groups.</li><li>Durations can be specified in the format #d#h#m or HH:mm (1d3h30m or 27:30 for 1 day, 3 hours, 30 minutes)</li><li>Use the supplied template as an example.</li></ul>';
        $strings['ReservationImportInstructions'] = '<ul><li>File must be in CSV format with UTF-8 encoding.</li><li>Email, resource names, begin, and end are required fields.</li><li>Begin and end require full date time. Recommended format is YYYY-mm-dd HH:mm (2017-12-31 20:30).</li><li>Rules, conflicts, and valid time slots will not be checked.</li><li>Notifications will not be sent.</li><li>Attribute validity will not be enforced.</li><li>Comma separate multiple resource names.</li><li>Use the supplied template as an example.</li></ul>';
        $strings['AutoReleaseMinutes'] = 'Phút tự động phát hành';
        $strings['CreditsPeak'] = 'Tín dụng (cao điểm)';
        $strings['CreditsOffPeak'] = 'Tín dụng (ngoài giờ cao điểm)';
        $strings['ResourceMinLengthCsv'] = 'Độ dài đặt chỗ tối thiểu';
        $strings['ResourceMaxLengthCsv'] = 'Độ dài đặt chỗ tối đa';
        $strings['ResourceBufferTimeCsv'] = 'Thời gian đệm đặt chỗ';
        $strings['ResourceMinNoticeAddCsv'] = 'Thông báo tối thiểu khi thêm đặt chỗ';
        $strings['ResourceMinNoticeUpdateCsv'] = 'Thông báo tối thiểu khi cập nhật đặt chỗ';
        $strings['ResourceMinNoticeDeleteCsv'] = 'Thông báo tối thiểu khi xóa đặt chỗ';
        $strings['ResourceMaxNoticeCsv'] = 'Thông báo tối đa khi kết thúc đặt chỗ';
        $strings['Export'] = 'Xuất';
        $strings['DeleteMultipleUserWarning'] = 'Xóa những người dùng này sẽ loại bỏ tất cả các đặt chỗ hiện tại, tương lai và lịch sử của họ. Không có email nào sẽ được gửi.';
        $strings['DeleteMultipleReservationsWarning'] = 'Không có email nào sẽ được gửi.';
        $strings['ErrorMovingReservation'] = 'Lỗi khi di chuyển đặt chỗ';
        $strings['SelectUser'] = 'Chọn người dùng';
        $strings['InviteUsers'] = 'Mời người dùng';
        $strings['InviteUsersLabel'] = 'Nhập địa chỉ email của những người bạn muốn mời';
        $strings['ApplyToCurrentUsers'] = 'Áp dụng cho người dùng hiện tại';
        $strings['ReasonText'] = 'Lý do';
        $strings['NoAvailableMatchingTimes'] = 'Không có thời gian khả dụng nào phù hợp với tìm kiếm của bạn';
        $strings['Schedules'] = 'Lịch trình';
        $strings['NotifyUser'] = 'Thông báo người dùng';
        $strings['UpdateUsersOnImport'] = 'Cập nhật người dùng hiện có nếu email đã tồn tại';
        $strings['UpdateResourcesOnImport'] = 'Cập nhật tài nguyên hiện có nếu tên đã tồn tại';
        $strings['Reject'] = 'Từ chối';
        $strings['CheckingAvailability'] = 'Đang kiểm tra khả dụng';
        $strings['CreditPurchaseNotEnabled'] = 'Bạn chưa bật khả năng mua tín dụng';
        $strings['CreditsEachCost1'] = 'Mỗi';
        $strings['CreditsEachCost2'] = 'tín dụng có giá';
        $strings['CreditsCount'] = 'Số lượng tín dụng';
        $strings['CreditsCost'] = 'Giá tiền';
        $strings['Currency'] = 'Tiền tệ';
        $strings['PayPalClientId'] = 'Client ID';
        $strings['PayPalSecret'] = 'Secret';
        $strings['PayPalEnvironment'] = 'Môi trường';
        $strings['Sandbox'] = 'Sandbox';
        $strings['Live'] = 'Live';
        $strings['StripePublishableKey'] = 'Publishable key';
        $strings['StripeSecretKey'] = 'Secret key';
        $strings['CreditsUpdated'] = 'Giá tín dụng đã được cập nhật';
        $strings['GatewaysUpdated'] = 'Cổng thanh toán đã được cập nhật';
        $strings['PurchaseSummary'] = 'Tóm tắt mua hàng';
        $strings['EachCreditCosts'] = 'Mỗi tín dụng có giá';
        $strings['Checkout'] = 'Thanh toán';
        $strings['Quantity'] = 'Số lượng';
        $strings['CreditPurchase'] = 'Mua tín dụng';
        $strings['EmptyCart'] = 'Giỏ hàng của bạn trống.';
        $strings['BuyCredits'] = 'Mua tín dụng';
        $strings['CreditsPurchased'] = 'tín dụng đã mua.';
        $strings['ViewYourCredits'] = 'Xem tín dụng của bạn';
        $strings['TryAgain'] = 'Thử lại';
        $strings['PurchaseFailed'] = 'Chúng tôi gặp sự cố khi xử lý thanh toán của bạn.';
        $strings['NoteCreditsPurchased'] = 'Tín dụng đã mua';
        $strings['CreditsUpdatedLog'] = 'Tín dụng được cập nhật bởi %s';
        $strings['ReservationCreatedLog'] = 'Đặt chỗ đã tạo. Số tham chiếu %s';
        $strings['ReservationUpdatedLog'] = 'Đặt chỗ đã cập nhật. Số tham chiếu %s';
        $strings['ReservationDeletedLog'] = 'Đặt chỗ đã xóa. Số tham chiếu %s';
        $strings['BuyMoreCredits'] = 'Mua thêm tín dụng';
        $strings['Transactions'] = 'Giao dịch';
        $strings['Cost'] = 'Chi phí';
        $strings['PaymentGateways'] = 'Cổng thanh toán';
        $strings['CreditHistory'] = 'Lịch sử tín dụng';
        $strings['TransactionHistory'] = 'Lịch sử giao dịch';
        $strings['Date'] = 'Ngày';
        $strings['Note'] = 'Ghi chú';
        $strings['CreditsBefore'] = 'Tín dụng trước';
        $strings['CreditsAfter'] = 'Tín dụng sau';
        $strings['TransactionFee'] = 'Phí giao dịch';
        $strings['InvoiceNumber'] = 'Số hóa đơn';
        $strings['TransactionId'] = 'ID giao dịch';
        $strings['Gateway'] = 'Cổng';
        $strings['GatewayTransactionDate'] = 'Ngày giao dịch cổng';
        $strings['Refund'] = 'Hoàn tiền';
        $strings['IssueRefund'] = 'Phát hành hoàn tiền';
        $strings['RefundIssued'] = 'Hoàn tiền thành công';
        $strings['RefundAmount'] = 'Số tiền hoàn';
        $strings['AmountRefunded'] = 'Đã hoàn';
        $strings['FullyRefunded'] = 'Đã hoàn toàn bộ';
        $strings['YourCredits'] = 'Tín dụng của bạn';
        $strings['PayWithCard'] = 'Thanh toán bằng thẻ';
        $strings['or'] = 'hoặc';
        $strings['CreditsRequired'] = 'Tín dụng yêu cầu';
        $strings['AddToGoogleCalendar'] = 'Thêm vào Google';
        $strings['Image'] = 'Hình ảnh';
        $strings['ChooseOrDropFile'] = 'Chọn tệp hoặc kéo thả vào đây';
        $strings['SlackBookResource'] = 'Đặt %s ngay';
        $strings['SlackBookNow'] = 'Đặt ngay';
        $strings['SlackNotFound'] = 'Không tìm thấy tài nguyên với tên đó. Đặt ngay để bắt đầu đặt chỗ mới.';
        $strings['AutomaticallyAddToGroup'] = 'Tự động thêm người dùng mới vào nhóm này';
        $strings['GroupAutomaticallyAdd'] = 'Tự động thêm';
        $strings['TermsOfService'] = 'Điều khoản dịch vụ';
        $strings['EnterTermsManually'] = 'Nhập điều khoản thủ công';
        $strings['LinkToTerms'] = 'Liên kết đến điều khoản';
        $strings['UploadTerms'] = 'Tải lên điều khoản';
        $strings['RequireTermsOfServiceAcknowledgement'] = 'Yêu cầu xác nhận điều khoản dịch vụ';
        $strings['UponReservation'] = 'Khi đặt chỗ';
        $strings['UponRegistration'] = 'Khi đăng ký';
        $strings['ViewTerms'] = 'Xem điều khoản dịch vụ';
        $strings['IAccept'] = 'Tôi chấp nhận';
        $strings['TheTermsOfService'] = 'điều khoản dịch vụ';
        $strings['DisplayPage'] = 'Hiển thị trang';
        $strings['AvailableAllYear'] = 'Cả năm';
        $strings['Availability'] = 'Tính khả dụng';
        $strings['AvailableBetween'] = 'Khả dụng giữa';
        $strings['ConcurrentYes'] = 'Tài nguyên có thể được đặt bởi nhiều người cùng lúc';
        $strings['ConcurrentNo'] = 'Tài nguyên không thể được đặt bởi nhiều người cùng lúc';
        $strings['ScheduleAvailabilityEarly'] = 'Lịch này chưa khả dụng. Nó sẽ khả dụng';
        $strings['ScheduleAvailabilityLate'] = 'Lịch này không còn khả dụng. Nó đã khả dụng';
        $strings['ResourceImages'] = 'Hình ảnh tài nguyên';
        $strings['FullAccess'] = 'Truy cập đầy đủ';
        $strings['ViewOnly'] = 'Chỉ xem';
        $strings['Purge'] = 'Xóa vĩnh viễn';
        $strings['UsersWillBeDeleted'] = 'người dùng sẽ bị xóa';
        $strings['BlackoutsWillBeDeleted'] = 'thời gian chặn sẽ bị xóa';
        $strings['ReservationsWillBePurged'] = 'đặt chỗ sẽ bị xóa vĩnh viễn';
        $strings['ReservationsWillBeDeleted'] = 'đặt chỗ sẽ bị xóa';
        $strings['PermanentlyDeleteUsers'] = 'Xóa vĩnh viễn người dùng chưa đăng nhập kể từ';
        $strings['DeleteBlackoutsBefore'] = 'Xóa thời gian chặn trước';
        $strings['DeletedReservations'] = 'Đặt chỗ đã xóa';
        $strings['DeleteReservationsBefore'] = 'Xóa đặt chỗ trước';
        $strings['SwitchToACustomLayout'] = 'Chuyển sang bố cục tùy chỉnh';
        $strings['SwitchToAStandardLayout'] = 'Chuyển sang bố cục tiêu chuẩn';
        $strings['ThisScheduleUsesACustomLayout'] = 'Lịch này sử dụng bố cục tùy chỉnh';
        $strings['ThisScheduleUsesAStandardLayout'] = 'Lịch này sử dụng bố cục tiêu chuẩn';
        $strings['SwitchLayoutWarning'] = 'Bạn có chắc muốn thay đổi loại bố cục? Điều này sẽ xóa tất cả các khe thời gian hiện có.';
        $strings['DeleteThisTimeSlot'] = 'Xóa khe thời gian này?';
        $strings['Refresh'] = 'Làm mới';
        $strings['ViewReservation'] = 'Xem đặt chỗ';
        $strings['PublicId'] = 'ID công khai';
        $strings['Public'] = 'Công khai';
        $strings['AtomFeedTitle'] = 'Đặt chỗ %s';
        $strings['DefaultStyle'] = 'Kiểu mặc định';
        $strings['Standard'] = 'Tiêu chuẩn';
        $strings['Wide'] = 'Rộng';
        $strings['Tall'] = 'Cao';
        $strings['EmailTemplate'] = 'Mẫu email';
        $strings['SelectEmailTemplate'] = 'Chọn mẫu email';
        $strings['ReloadOriginalContents'] = 'Tải lại nội dung gốc';
        $strings['UpdateEmailTemplateSuccess'] = 'Đã cập nhật mẫu email';
        $strings['UpdateEmailTemplateFailure'] = 'Không thể cập nhật mẫu email. Kiểm tra xem thư mục có thể ghi được không.';
        $strings['BulkResourceDelete'] = 'Xóa tài nguyên hàng loạt';
        $strings['NewVersion'] = 'Phiên bản mới!';
        $strings['WhatsNew'] = 'Có gì mới?';
        $strings['OnlyViewedCalendar'] = 'Lịch này chỉ có thể xem từ chế độ xem lịch';
        $strings['Grid'] = 'Lưới';
        $strings['List'] = 'Danh sách';
        $strings['NoReservationsFound'] = 'Không tìm thấy đặt chỗ';
        $strings['EmailReservation'] = 'Email đặt chỗ';
        $strings['AdHocMeeting'] = 'Cuộc họp đột xuất';
        $strings['NextReservation'] = 'Đặt chỗ tiếp theo';
        $strings['CurrentReservation'] = 'Đặt chỗ hiện tại';
        $strings['MissedCheckin'] = 'Bỏ lỡ check in';
        $strings['MissedCheckout'] = 'Bỏ lỡ check out';
        $strings['Utilization'] = 'Sử dụng';
        $strings['SpecificTime'] = 'Thời gian cụ thể';
        $strings['ReservationSeriesEndingPreference'] = 'Khi chuỗi đặt chỗ định kỳ của tôi kết thúc';
        $strings['NotAttending'] = 'Không tham dự';
        $strings['ViewAvailability'] = 'Xem tính khả dụng';
        $strings['ReservationDetails'] = 'Chi tiết đặt chỗ';
        $strings['StartTime'] = 'Thời gian bắt đầu';
        $strings['EndTime'] = 'Thời gian kết thúc';
        $strings['New'] = 'Mới';
        $strings['Updated'] = 'Đã cập nhật';
        $strings['Custom'] = 'Tùy chỉnh';
        $strings['AddDate'] = 'Thêm ngày';
        $strings['RepeatOn'] = 'Lặp lại vào';
        $strings['ScheduleConcurrentMaximum'] = 'Tổng cộng <b>%s</b> tài nguyên có thể được đặt đồng thời';
        $strings['ScheduleConcurrentMaximumNone'] = 'Không có giới hạn số lượng tài nguyên đặt đồng thời';
        $strings['ScheduleMaximumConcurrent'] = 'Số lượng tài nguyên tối đa được đặt đồng thời';
        $strings['ScheduleMaximumConcurrentNote'] = 'Khi được đặt, tổng số tài nguyên có thể được đặt đồng thời cho lịch này sẽ bị giới hạn.';
        $strings['ScheduleResourcesPerReservationMaximum'] = 'Mỗi đặt chỗ bị giới hạn tối đa <b>%s</b> tài nguyên';
        $strings['ScheduleResourcesPerReservationNone'] = 'Không có giới hạn số lượng tài nguyên mỗi đặt chỗ';
        $strings['ScheduleResourcesPerReservation'] = 'Số lượng tài nguyên tối đa mỗi đặt chỗ';
        $strings['ResourceConcurrentReservations'] = 'Cho phép %s đặt chỗ đồng thời';
        $strings['ResourceConcurrentReservationsNone'] = 'Không cho phép đặt chỗ đồng thời';
        $strings['AllowConcurrentReservations'] = 'Cho phép đặt chỗ đồng thời';
        $strings['ResourceDisplayInstructions'] = 'Chưa chọn tài nguyên. Bạn có thể tìm URL để hiển thị tài nguyên trong Quản lý ứng dụng, Tài nguyên. Tài nguyên phải có thể truy cập công khai.';
        $strings['Owner'] = 'Chủ sở hữu';
        $strings['MaximumConcurrentReservations'] = 'Số đặt chỗ đồng thời tối đa';
        $strings['NotifyUsers'] = 'Thông báo người dùng';
        $strings['Message'] = 'Tin nhắn';
        $strings['AllUsersWhoHaveAReservationInTheNext'] = 'Bất kỳ ai có đặt chỗ trong';
        $strings['ChangeResourceStatus'] = 'Thay đổi trạng thái tài nguyên';
        $strings['UpdateGroupsOnImport'] = 'Cập nhật nhóm hiện có nếu tên trùng khớp';
        $strings['GroupsImportInstructions'] = '<ul><li>Tệp phải ở định dạng CSV.</li><li>Tên là bắt buộc.</li><li>Danh sách thành viên phải là danh sách email cách nhau bằng dấu phẩy.</li><li>Danh sách thành viên trống khi cập nhật nhóm sẽ giữ nguyên thành viên.</li><li>Danh sách quyền phải là danh sách tên tài nguyên cách nhau bằng dấu phẩy.</li><li>Danh sách quyền trống khi cập nhật nhóm sẽ giữ nguyên quyền.</li><li>Sử dụng mẫu được cung cấp làm ví dụ.</li></ul>';
        $strings['PhoneRequired'] = 'Số điện thoại là bắt buộc';
        $strings['OrganizationRequired'] = 'Tổ chức là bắt buộc';
        $strings['PositionRequired'] = 'Chức vụ là bắt buộc';
        $strings['GroupMembership'] = 'Thành viên nhóm';
        $strings['AvailableGroups'] = 'Nhóm khả dụng';
        $strings['CheckingAvailabilityError'] = 'Không thể lấy tính khả dụng của tài nguyên - quá nhiều tài nguyên';
        $strings['ScanToSchedule'] = 'Quét để lên lịch';
        $strings['MaintenanceNotice'] = 'Hiện đang bảo trì. Chúng tôi sẽ quay lại sớm.';
        $strings['MoreResourceActions'] = 'Thêm hành động tài nguyên';
        // End Strings

        // Install
        $strings['InstallApplication'] = 'Cài đặt LibreBooking';
        $strings['IncorrectInstallPassword'] = 'Xin lỗi, mật khẩu không chính xác.';
        $strings['SetInstallPassword'] = 'Bạn phải đặt mật khẩu cài đặt trước khi có thể chạy cài đặt.';
        $strings['InstallPasswordInstructions'] = 'Trong %s vui lòng đặt %s thành mật khẩu ngẫu nhiên và khó đoán, sau đó quay lại trang này.<br/>Bạn có thể sử dụng %s';
        $strings['NoUpgradeNeeded'] = 'LibreBooking đã được cập nhật. Không cần nâng cấp.';
        $strings['ProvideInstallPassword'] = 'Vui lòng cung cấp mật khẩu cài đặt của bạn.';
        $strings['InstallPasswordLocation'] = 'Có thể tìm thấy tại %s trong %s.';
        $strings['VerifyInstallSettings'] = 'Xác minh các cài đặt mặc định sau trước khi tiếp tục. Hoặc bạn có thể thay đổi chúng trong %s.';
        $strings['DatabaseName'] = 'Tên cơ sở dữ liệu';
        $strings['DatabaseUser'] = 'Người dùng cơ sở dữ liệu';
        $strings['DatabaseHost'] = 'Máy chủ cơ sở dữ liệu';
        $strings['DatabaseCredentials'] = 'Bạn phải cung cấp thông tin đăng nhập của người dùng MySQL có quyền tạo cơ sở dữ liệu. Nếu không biết, hãy liên hệ với quản trị viên cơ sở dữ liệu. Trong nhiều trường hợp, root sẽ hoạt động.';
        $strings['MySQLUser'] = 'Người dùng MySQL';
        $strings['InstallOptionsWarning'] = 'Các tùy chọn sau có thể sẽ không hoạt động trong môi trường lưu trữ. Nếu bạn đang cài đặt trong môi trường lưu trữ, hãy sử dụng công cụ hướng dẫn MySQL để hoàn thành các bước này.';
        $strings['CreateDatabase'] = 'Tạo cơ sở dữ liệu';
        $strings['CreateDatabaseUser'] = 'Tạo người dùng cơ sở dữ liệu';
        $strings['PopulateExampleData'] = 'Nhập dữ liệu mẫu. Tạo tài khoản quản trị: admin/password và tài khoản người dùng: user/password';
        $strings['DataWipeWarning'] = 'Cảnh báo: Điều này sẽ xóa mọi dữ liệu hiện có';
        $strings['RunInstallation'] = 'Chạy cài đặt';
        $strings['UpgradeNotice'] = 'Bạn đang nâng cấp từ phiên bản <b>%s</b> lên phiên bản <b>%s</b>';
        $strings['RunUpgrade'] = 'Chạy nâng cấp';
        $strings['Executing'] = 'Đang thực thi';
        $strings['StatementFailed'] = 'Thất bại. Chi tiết:';
        $strings['SQLStatement'] = 'Câu lệnh SQL:';
        $strings['ErrorCode'] = 'Mã lỗi:';
        $strings['ErrorText'] = 'Văn bản lỗi:';
        $strings['InstallationSuccess'] = 'Cài đặt hoàn tất thành công!';
        $strings['RegisterAdminUser'] = 'Đăng ký người dùng quản trị của bạn. Điều này là bắt buộc nếu bạn không nhập dữ liệu mẫu. Đảm bảo rằng $conf[\'settings\'][\'allow.self.registration\'] = \'true\' trong tệp %s của bạn.';
        $strings['LoginWithSampleAccounts'] = 'Nếu bạn đã nhập dữ liệu mẫu, bạn có thể đăng nhập bằng admin/password cho người dùng quản trị hoặc user/password cho người dùng cơ bản.';
        $strings['InstalledVersion'] = 'Bây giờ bạn đang chạy phiên bản %s của LibreBooking';
        $strings['InstallUpgradeConfig'] = 'Nên nâng cấp tệp cấu hình của bạn';
        $strings['InstallationFailure'] = 'Có vấn đề với quá trình cài đặt. Vui lòng sửa chúng và thử lại cài đặt.';
        $strings['ConfigureApplication'] = 'Cấu hình LibreBooking';
        $strings['ConfigUpdateSuccess'] = 'Tệp cấu hình của bạn hiện đã được cập nhật!';
        $strings['ConfigUpdateFailure'] = 'Chúng tôi không thể tự động cập nhật tệp cấu hình của bạn. Vui lòng ghi đè nội dung của config.php bằng nội dung sau:';
        $strings['ScriptUrlWarning'] = 'Cài đặt <em>script.url</em> của bạn có thể không chính xác. Hiện tại là <strong>%s</strong>, chúng tôi nghĩ nó nên là <strong>%s</strong>';
        // End Install

        // Errors
        $strings['LoginError'] = 'Không thể xác thực tên người dùng hoặc mật khẩu của bạn';
        $strings['ReservationFailed'] = 'Không thể tạo đặt chỗ của bạn';
        $strings['MinNoticeError'] = 'Đặt chỗ này yêu cầu thông báo trước. Ngày và giờ sớm nhất có thể đặt là %s.';
        $strings['MinNoticeErrorUpdate'] = 'Thay đổi đặt chỗ này yêu cầu thông báo trước. Không được phép thay đổi các đặt chỗ trước %s.';
        $strings['MinNoticeErrorDelete'] = 'Xóa đặt chỗ này yêu cầu thông báo trước. Không được phép xóa các đặt chỗ trước %s.';
        $strings['MaxNoticeError'] = 'Không thể đặt chỗ này quá xa trong tương lai. Ngày và giờ muộn nhất có thể đặt là %s.';
        $strings['MinDurationError'] = 'Đặt chỗ này phải kéo dài ít nhất %s.';
        $strings['MaxDurationError'] = 'Đặt chỗ này không được kéo dài quá %s.';
        $strings['ConflictingAccessoryDates'] = 'Không đủ số lượng các phụ kiện sau:';
        $strings['NoResourcePermission'] = 'Bạn không có quyền truy cập một hoặc nhiều tài nguyên được yêu cầu.';
        $strings['ConflictingReservationDates'] = 'Có các đặt chỗ xung đột vào các ngày sau:';
        $strings['InstancesOverlapRule'] = 'Một số trường hợp của chuỗi đặt chỗ bị chồng chéo:';
        $strings['StartDateBeforeEndDateRule'] = 'Ngày và giờ bắt đầu phải trước ngày và giờ kết thúc.';
        $strings['StartIsInPast'] = 'Ngày và giờ bắt đầu không thể ở quá khứ.';
        $strings['EmailDisabled'] = 'Quản trị viên đã tắt thông báo email.';
        $strings['ValidLayoutRequired'] = 'Các khoảng thời gian phải được cung cấp cho tất cả 24 giờ trong ngày bắt đầu và kết thúc vào lúc 00:00.';
        $strings['CustomAttributeErrors'] = 'Có vấn đề với các thuộc tính bổ sung bạn đã cung cấp:';
        $strings['CustomAttributeRequired'] = '%s là trường bắt buộc.';
        $strings['CustomAttributeInvalid'] = 'Giá trị được cung cấp cho %s không hợp lệ.';
        $strings['AttachmentLoadingError'] = 'Xin lỗi, đã có sự cố khi tải tệp được yêu cầu.';
        $strings['InvalidAttachmentExtension'] = 'Bạn chỉ có thể tải lên các tệp loại: %s';
        $strings['InvalidStartSlot'] = 'Ngày và giờ bắt đầu được yêu cầu không hợp lệ.';
        $strings['InvalidEndSlot'] = 'Ngày và giờ kết thúc được yêu cầu không hợp lệ.';
        $strings['MaxParticipantsError'] = '%s chỉ có thể hỗ trợ %s người tham gia.';
        $strings['ReservationCriticalError'] = 'Đã có lỗi nghiêm trọng khi lưu đặt chỗ của bạn. Nếu vấn đề tiếp tục, hãy liên hệ với quản trị viên hệ thống.';
        $strings['InvalidStartReminderTime'] = 'Thời gian nhắc nhở bắt đầu không hợp lệ.';
        $strings['InvalidEndReminderTime'] = 'Thời gian nhắc nhở kết thúc không hợp lệ.';
        $strings['QuotaExceeded'] = 'Vượt quá giới hạn hạn ngạch.';
        $strings['MultiDayRule'] = '%s không cho phép đặt chỗ qua nhiều ngày.';
        $strings['InvalidReservationData'] = 'Có vấn đề với yêu cầu đặt chỗ của bạn.';
        $strings['PasswordError'] = 'Mật khẩu phải chứa ít nhất %s chữ cái và ít nhất %s chữ số.';
        $strings['PasswordErrorRequirements'] = 'Mật khẩu phải chứa sự kết hợp của ít nhất %s chữ cái in hoa và in thường và %s chữ số.';
        $strings['NoReservationAccess'] = 'Bạn không được phép thay đổi đặt chỗ này.';
        $strings['PasswordControlledExternallyError'] = 'Mật khẩu của bạn được kiểm soát bởi hệ thống bên ngoài và không thể cập nhật ở đây.';
        $strings['AccessoryResourceRequiredErrorMessage'] = 'Phụ kiện %s chỉ có thể được đặt cùng với tài nguyên %s';
        $strings['AccessoryMinQuantityErrorMessage'] = 'Bạn phải đặt ít nhất %s phụ kiện %s';
        $strings['AccessoryMaxQuantityErrorMessage'] = 'Bạn không thể đặt nhiều hơn %s phụ kiện %s';
        $strings['AccessoryResourceAssociationErrorMessage'] = 'Phụ kiện \'%s\' không thể được đặt cùng với các tài nguyên được yêu cầu';
        $strings['NoResources'] = 'Bạn chưa thêm bất kỳ tài nguyên nào.';
        $strings['ParticipationNotAllowed'] = 'Bạn không được phép tham gia đặt chỗ này.';
        $strings['ReservationCannotBeCheckedInTo'] = 'Không thể check in vào đặt chỗ này.';
        $strings['ReservationCannotBeCheckedOutFrom'] = 'Không thể check out khỏi đặt chỗ này.';
        $strings['InvalidEmailDomain'] = 'Địa chỉ email đó không thuộc tên miền được phép';
        $strings['TermsOfServiceError'] = 'Bạn phải chấp nhận Điều khoản dịch vụ';
        $strings['UserNotFound'] = 'Không tìm thấy người dùng đó';
        $strings['ScheduleAvailabilityError'] = 'Lịch này khả dụng trong khoảng %s đến %s';
        $strings['ReservationNotFoundError'] = 'Không tìm thấy đặt chỗ';
        $strings['ReservationNotAvailable'] = 'Đặt chỗ không khả dụng';
        $strings['TitleRequiredRule'] = 'Tiêu đề đặt chỗ là bắt buộc';
        $strings['DescriptionRequiredRule'] = 'Mô tả đặt chỗ là bắt buộc';
        $strings['WhatCanThisGroupManage'] = 'Nhóm này có thể quản lý những gì?';
        $strings['ReservationParticipationActivityPreference'] = 'Khi ai đó tham gia hoặc rời khỏi đặt chỗ của tôi';
        $strings['RegisteredAccountRequired'] = 'Chỉ người dùng đã đăng ký mới có thể đặt chỗ';
        $strings['InvalidNumberOfResourcesError'] = 'Số lượng tài nguyên tối đa có thể được đặt trong một đặt chỗ là %s';
        $strings['ScheduleTotalReservationsError'] = 'Lịch này chỉ cho phép %s tài nguyên được đặt đồng thời. Đặt chỗ này sẽ vi phạm giới hạn đó vào các ngày sau:';
        $strings['SelfRegistrationDisabled'] = 'Người dùng chưa đăng ký và tự đăng ký đã bị tắt. Vui lòng liên hệ với quản trị viên để tạo tài khoản của bạn.';
        // End Errors

        // Page Titles
        $strings['CreateReservation'] = 'Tạo lịch đặt';
        $strings['EditReservation'] = 'Cập nhật lịch đặt';
        $strings['LogIn'] = 'Đăng nhập';
        $strings['ManageReservations'] = 'Quản lý lịch đặt';
        $strings['AwaitingActivation'] = 'Chờ kích hoạt';
        $strings['PendingApproval'] = 'Chờ phê duyệt';
        $strings['ManageSchedules'] = 'Quản lý lịch trình';
        $strings['ManageResources'] = 'Quản lý tài nguyên';
        $strings['ManageAccessories'] = 'Quản lý phụ kiện';
        $strings['ManageUsers'] = 'Quản lý người dùng';
        $strings['ManageGroups'] = 'Quản lý nhóm';
        $strings['ManageQuotas'] = 'Quản lý hạn ngạch';
        $strings['ManageBlackouts'] = 'Quản lý thời gian ngừng hoạt động';
        $strings['MyDashboard'] = 'Bảng điều khiển của tôi';
        $strings['ServerSettings'] = 'Cài đặt máy chủ';
        $strings['Dashboard'] = 'Bảng điều khiển';
        $strings['Help'] = 'Trợ giúp';
        $strings['Administration'] = 'Quản trị';
        $strings['About'] = 'Giới thiệu';
        $strings['Bookings'] = 'Đặt chỗ';
        $strings['Schedule'] = 'Lịch trình';
        $strings['Account'] = 'Tài khoản';
        $strings['EditProfile'] = 'Chỉnh sửa hồ sơ của tôi';
        $strings['FindAnOpening'] = 'Tìm một khoảng trống';
        $strings['OpenInvitations'] = 'Lời mời mở';
        $strings['ResourceCalendar'] = 'Lịch tài nguyên';
        $strings['Reservation'] = 'Lịch đặt mới';
        $strings['Install'] = 'Cài đặt';
        $strings['ChangePassword'] = 'Đổi mật khẩu';
        $strings['MyAccount'] = 'Tài khoản của tôi';
        $strings['Profile'] = 'Hồ sơ';
        $strings['ApplicationManagement'] = 'Quản lý ứng dụng';
        $strings['ForgotPassword'] = 'Quên mật khẩu';
        $strings['NotificationPreferences'] = 'Tùy chọn thông báo';
        $strings['ManageAnnouncements'] = 'Thông báo';
        $strings['Responsibilities'] = 'Trách nhiệm';
        $strings['GroupReservations'] = 'Đặt chỗ nhóm';
        $strings['ResourceReservations'] = 'Đặt chỗ tài nguyên';
        $strings['Customization'] = 'Tùy chỉnh';
        $strings['Attributes'] = 'Thuộc tính';
        $strings['AccountActivation'] = 'Kích hoạt tài khoản';
        $strings['ScheduleReservations'] = 'Đặt chỗ lịch trình';
        $strings['Reports'] = 'Báo cáo';
        $strings['GenerateReport'] = 'Tạo báo cáo mới';
        $strings['MySavedReports'] = 'Báo cáo đã lưu của tôi';
        $strings['CommonReports'] = 'Báo cáo phổ biến';
        $strings['ViewDay'] = 'Xem ngày';
        $strings['Group'] = 'Nhóm';
        $strings['ManageConfiguration'] = 'Cấu hình ứng dụng';
        $strings['LookAndFeel'] = 'Giao diện và cảm nhận';
        $strings['ManageResourceGroups'] = 'Nhóm tài nguyên';
        $strings['ManageResourceTypes'] = 'Loại tài nguyên';
        $strings['ManageResourceStatus'] = 'Trạng thái tài nguyên';
        $strings['ReservationColors'] = 'Màu đặt chỗ';
        $strings['SearchReservations'] = 'Tìm đặt chỗ';
        $strings['ManagePayments'] = 'Thanh toán';
        $strings['ViewCalendar'] = 'Xem lịch';
        $strings['DataCleanup'] = 'Dọn dẹp dữ liệu';
        $strings['ManageEmailTemplates'] = 'Quản lý mẫu email';
        $strings['CheckResources'] = 'Kiểm tra tài nguyên';
        $strings['CheckSchedules'] = 'Kiểm tra lịch trình';
        // End Page Titles

        // Day representations
        $strings['DaySundaySingle'] = 'C'; // Chủ nhật
        $strings['DayMondaySingle'] = 'H'; // Thứ hai
        $strings['DayTuesdaySingle'] = 'B'; // Thứ ba
        $strings['DayWednesdaySingle'] = 'T'; // Thứ tư
        $strings['DayThursdaySingle'] = 'N'; // Thứ năm
        $strings['DayFridaySingle'] = 'S'; // Thứ sáu
        $strings['DaySaturdaySingle'] = 'B'; // Thứ bảy
        
        $strings['DaySundayAbbr'] = 'CN'; // Chủ nhật
        $strings['DayMondayAbbr'] = 'T2'; // Thứ hai
        $strings['DayTuesdayAbbr'] = 'T3'; // Thứ ba
        $strings['DayWednesdayAbbr'] = 'T4'; // Thứ tư
        $strings['DayThursdayAbbr'] = 'T5'; // Thứ năm
        $strings['DayFridayAbbr'] = 'T6'; // Thứ sáu
        $strings['DaySaturdayAbbr'] = 'T7'; // Thứ bảy        
        // End Day representations

        // Email Subjects
        $strings['ReservationApprovedSubject'] = 'Đặt chỗ của bạn đã được phê duyệt';
        $strings['ReservationCreatedSubject'] = 'Đặt chỗ của bạn đã được tạo';
        $strings['ReservationUpdatedSubject'] = 'Đặt chỗ của bạn đã được cập nhật';
        $strings['ReservationDeletedSubject'] = 'Đặt chỗ của bạn đã bị xóa';
        $strings['ReservationCreatedAdminSubject'] = 'Thông báo: Một đặt chỗ đã được tạo';
        $strings['ReservationUpdatedAdminSubject'] = 'Thông báo: Một đặt chỗ đã được cập nhật';
        $strings['ReservationDeleteAdminSubject'] = 'Thông báo: Một đặt chỗ đã bị xóa';
        $strings['ReservationApprovalAdminSubject'] = 'Thông báo: Đặt chỗ cần được phê duyệt';
        $strings['ParticipantAddedSubject'] = 'Thông báo tham gia đặt chỗ';
        $strings['ParticipantDeletedSubject'] = 'Đặt chỗ đã bị xóa';
        $strings['InviteeAddedSubject'] = 'Lời mời đặt chỗ';
        $strings['ResetPasswordRequest'] = 'Yêu cầu đặt lại mật khẩu';
        $strings['ActivateYourAccount'] = 'Vui lòng kích hoạt tài khoản của bạn';
        $strings['ReportSubject'] = 'Báo cáo bạn yêu cầu (%s)';
        $strings['ReservationStartingSoonSubject'] = 'Đặt chỗ cho %s sắp bắt đầu';
        $strings['ReservationEndingSoonSubject'] = 'Đặt chỗ cho %s sắp kết thúc';
        $strings['UserAdded'] = 'Một người dùng mới đã được thêm';
        $strings['UserDeleted'] = 'Tài khoản người dùng %s đã bị xóa bởi %s';
        $strings['GuestAccountCreatedSubject'] = 'Chi tiết tài khoản %s của bạn';
        $strings['AccountCreatedSubject'] = 'Chi tiết tài khoản %s của bạn';
        $strings['InviteUserSubject'] = '%s đã mời bạn tham gia %s';

        $strings['ReservationApprovedSubjectWithResource'] = 'Đặt chỗ đã được phê duyệt cho %s';
        $strings['ReservationCreatedSubjectWithResource'] = 'Đặt chỗ được tạo cho %s';
        $strings['ReservationUpdatedSubjectWithResource'] = 'Đặt chỗ được cập nhật cho %s';
        $strings['ReservationDeletedSubjectWithResource'] = 'Đặt chỗ đã bị xóa cho %s';
        $strings['ReservationCreatedAdminSubjectWithResource'] = 'Thông báo: Đặt chỗ được tạo cho %s';
        $strings['ReservationUpdatedAdminSubjectWithResource'] = 'Thông báo: Đặt chỗ được cập nhật cho %s';
        $strings['ReservationDeleteAdminSubjectWithResource'] = 'Thông báo: Đặt chỗ đã bị xóa cho %s';
        $strings['ReservationApprovalAdminSubjectWithResource'] = 'Thông báo: Đặt chỗ cho %s cần được phê duyệt';
        $strings['ParticipantAddedSubjectWithResource'] = '%s đã thêm bạn vào đặt chỗ cho %s';
        $strings['ParticipantUpdatedSubjectWithResource'] = '%s đã cập nhật đặt chỗ cho %s';
        $strings['ParticipantDeletedSubjectWithResource'] = '%s đã xóa đặt chỗ cho %s';
        $strings['InviteeAddedSubjectWithResource'] = '%s đã mời bạn tham gia đặt chỗ cho %s';
        $strings['MissedCheckinEmailSubject'] = 'Bỏ lỡ check-in cho %s';
        $strings['ReservationShareSubject'] = '%s đã chia sẻ đặt chỗ cho %s';
        $strings['ReservationSeriesEndingSubject'] = 'Reservation series for %s is ending on %s';
        $strings['ReservationParticipantAccept'] = '%s đã chấp nhận lời mời đặt chỗ của bạn cho %s vào %s';
        $strings['ReservationParticipantDecline'] = '%s đã từ chối lời mời đặt chỗ của bạn cho %s vào %s';
        $strings['ReservationParticipantJoin'] = '%s đã tham gia đặt chỗ của bạn cho %s vào %s';
        $strings['ReservationAvailableSubject'] = '%s khả dụng vào %s';
        $strings['ResourceStatusChangedSubject'] = 'Sự thay đổi về khả năng sử dụng của %s';
        // End Email Subjects

        //Past Reservations
        $strings['NoPastReservations'] = 'Bạn không có đặt chỗ trong quá khứ';
        $strings['PastReservations'] = 'Đặt chỗ trong quá khứ';
        $strings['AllNoPastReservations'] = 'Không có đặt chỗ trong quá khứ trong %s ngày trước';
        $strings['AllPastReservations'] = 'Tất cả đặt chỗ trong quá khứ';
        $strings['Yesterday'] = 'Hôm qua';
        $strings['EarlierThisWeek'] = 'Đầu tuần này';
        $strings['PreviousWeek'] = 'Tuần trước';
        //End Past Reservations

        //Group Upcoming Reservations
        $strings['GroupUpcomingReservations'] = 'Đặt chỗ sắp tới của nhóm tôi';
        $strings['NoGroupUpcomingReservations'] = 'Nhóm của bạn không có đặt chỗ sắp tới';
        //End Group Upcoming Reservations

        //Facebook Login SDK Error
        $strings['FacebookLoginErrorMessage'] = 'Đã xảy ra lỗi khi đăng nhập bằng facebook. Vui lòng thử lại.';
        //End Facebook Login SDK Error

        //Pending Approval Reservations in Dashboard
        $strings['NoPendingApprovalReservations'] = 'Bạn không có đặt chỗ nào đang chờ phê duyệt';
        $strings['PendingApprovalReservations'] = 'Đặt chỗ đang chờ phê duyệt';
        $strings['LaterThisMonth'] = 'Cuối tháng này';
        $strings['LaterThisYear'] = 'Cuối năm nay';
        $strings['Other'] = 'Khác';
        //End Pending Approval Reservations in Dashboard

        //Missing Check In/Out Reservations in Dashboard
        $strings['NoMissingCheckOutReservations'] = 'Không có đặt chỗ nào bị thiếu kiểm tra ra';
        $strings['MissingCheckOutReservations'] = 'Đặt chỗ thiếu kiểm tra ra';
        //End Missing Check In/Out Reservations in Dashboard

        //Schedule Resource Permissions
        $strings['NoResourcePermissions'] = 'Không thể xem chi tiết đặt chỗ vì bạn không có quyền đối với bất kỳ tài nguyên nào trong đặt chỗ này';
        //End Schedule Resource Permissions

        //View Resource
        $strings['Check'] = 'Kiểm tra';
        $strings['PermissionType'] = 'Loại quyền';
        $strings['NoResourcesToView'] = 'Không có tài nguyên nào có sẵn để xem.';
        //End View Resource

        //Datatables
        $strings['Info'] = "Hiển thị trang _PAGE_ trong tổng số _PAGES_ của _MAX_";
        $strings['LengthMenu'] = "Hiển thị _MENU_ bản ghi mỗi trang";
        //End Datatables

        $this->Strings = $strings;

        return $this->Strings;
    }

    /**
     * @return array
     */
    protected function _LoadDays()
    {
        $days = [];

        /***
         * DAY NAMES
         * All of these arrays MUST start with Sunday as the first element
         * and go through the seven day week, ending on Saturday
         ***/
        // The full day name
        $days['full'] = ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy']; // Tên đầy đủ của các ngày
        // Viết tắt ba chữ cái
        $days['abbr'] = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7']; 
        // Viết tắt hai chữ cái
        $days['two'] = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
        // Viết tắt một chữ cái
        $days['letter'] = ['C', 'H', 'B', 'T', 'N', 'S', 'B'];      

        $this->Days = $days;

        return $this->Days;
    }

    /**
     * @return array
     */
    protected function _LoadMonths()
    {
        $months = [];

        /***
         * MONTH NAMES
         * All of these arrays MUST start with January as the first element
         * and go through the twelve months of the year, ending on December
         ***/
        // The full month name
        $months['full'] = ['Tháng một', 'Tháng hai', 'Tháng ba', 'Tháng tư', 'Tháng năm', 'Tháng sáu', 'Tháng bảy', 'Tháng tám', 'Tháng chín', 'Tháng mười', 'Tháng mười một', 'Tháng mười hai']; // Tên đầy đủ của các tháng
        // The three letter month name
        $months['abbr'] = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'];

        $this->Months = $months;

        return $this->Months;
    }

    /**
     * @return array
     */
    protected function _LoadLetters()
    {
        $this->Letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

        return $this->Letters;
    }

    protected function _GetHtmlLangCode()
    {
        return 'en';
    }
}
