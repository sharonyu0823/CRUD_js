<?php /* include __DIR__ . '/parts/connect_db.php';

$pageName = 'mb_edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;


if (empty($sid)) {
    header('Location: 05-mb_list.php');
    exit;
}

$sql = "SELECT
`member_sid`,
`member_surname`,
`member_forename`,
`member_nickname`,
`member_email`,
`member_status` 
FROM `member`
WHERE member_sid = {$sid}";

$r = $pdo->query($sql)->fetch();

if (empty($r)) {
    header('Location: 05-mb_list.php');
    exit;
}

*/ ?>

<?php

$pageName = 'mb_edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
// echo $_GET['sid'];

if (empty($sid)) {
    header('Location: 05-mb_list.php');
    exit;
}
?>


<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/05-nav-bar-admin.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 fw-bolder">基本資料修改</h5>

                    <form name="mbEditForm" id="mbEditForm" onsubmit="checkForm(); return false;">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- success modal -->
<div class="modal" id="myModalSuccess" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modal_header_s">Modal Heading</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="modal_body_s">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="modal_footer_s">關閉</button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>

<script>
    retriveForm();

    function retriveForm() {
        const fd = new FormData();
        fd.append('sid', <?= $_GET['sid'] ?>);
        console.log(fd);

        fetch('05-mb_edit_select_api.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj.row);
                if (!obj.success) {
                    console.log(obj.error);
                } else {

                    let row = obj.row;
                    let {
                        member_sid,
                        member_surname,
                        member_forename,
                        member_nickname,
                        member_email,
                        member_status
                    } = row;

                    // console.log(member_status);
                    // console.log(typeof member_status);
                    // console.log(member_status === '1' ? 'checked' : '');
                    // console.log(member_status === '0' ? 'checked' : '');

                    document.querySelector('#mbEditForm').innerHTML = (
                        `<input type="hidden" name="sid" value="${member_sid}">
                        <div class="mb-3">
                            <label for="mbeNum" class="form-label">會員編號</label>
                            <input type="text" class="form-control" name="mbeNum" id="mbeNum" value="${member_sid}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="mbeSurname" class="form-label">姓氏</label>
                            <input type="text" class="form-control" name="mbeSurname" id="mbeSurname" value="${member_surname}">
                        </div>
                        <div class="mb-3">
                            <label for="mbeForename" class="form-label">名字</label>
                            <input type="text" class="form-control" name="mbeForename" id="mbeForename" value="${member_forename}">
                        </div>
                        <div class="mb-3">
                            <label for="mbeNickname" class="form-label">暱稱</label>
                            <input type="text" class="form-control" name="mbeNickname" id="mbeNickname" value="${member_nickname}">
                        </div>
                        <div class="mb-4">
                            <label for="mbeAccount" class="form-label">註冊信箱</label>
                            <input type="email" class="form-control" name="mbeAccount" id="mbeAccount" value="${member_email}" disabled>
                        </div>
                        <input class="form-check-input mb-4" type="radio" name="enable_disable" id="enable" value="1" ${member_status === '1' ? 'checked' : ''} onclick="return confirm('確定要啟用帳號嗎?')">
                        <label class="form-check-label" for="enable">
                            啟用
                        </label>
                        &nbsp&nbsp&nbsp
                        <input class="form-check-input mb-4" type="radio" name="enable_disable" id="disable" value="0" ${member_status === '0' ? 'checked' : ''} onclick="return confirm('確定要停用帳號嗎?')">
                        <label class="form-check-label" for="disable">
                            停用
                        </label>
                        <br>
                        <button type="submit" class="btn btn-primary" id="mbe_button">確認送出</button>
                        `
                    )
                }
            })

    }

    function checkForm() {
        const fd = new FormData(document.mbEditForm);

        const myModalLS = new bootstrap.Modal(document.getElementById('myModalSuccess'), {
            keyboard: false
        });

        // 查出舊資料

        // TODO: 檢查欄位資料

        fetch('05-mb_edit_update_api.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (!obj.success) {
                    myModalLS.show();
                    document.querySelector('#modal_header_s').innerHTML = '修改';
                    document.querySelector('#modal_body_s').innerHTML = obj.error;
                } else {
                    myModalLS.show();
                    document.querySelector('#modal_header_s').innerHTML = '修改';
                    document.querySelector('#modal_body_s').innerHTML = '修改成功';
                    document.querySelector('#modal_footer_s').addEventListener('click', () => {
                        location.href = '05-mb_list.php';
                    });
                }
            })
    }
</script>

<?php include __DIR__ . '/parts/html-foot.php'; ?>