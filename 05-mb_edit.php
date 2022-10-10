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

?>

<!-- $sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
// echo $_GET['sid'];

if (empty($sid)) {
    header('Location: 05-mb_list.php');
    exit;
} -->




<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/05-nav-bar-admin.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 fw-bolder">基本資料修改</h5>

                    <form name="mbEditForm" onsubmit="checkForm(); return false;">
                        <input type="hidden" name="sid">
                        <div class="mb-3">
                            <label for="mbeNum" class="form-label">會員編號</label>
                            <input type="text" class="form-control" name="mbeNum" id="mbeNum" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="mbeSurname" class="form-label">姓氏</label>
                            <input type="text" class="form-control" name="mbeSurname" id="mbeSurname">
                        </div>
                        <div class="mb-3">
                            <label for="mbeForename" class="form-label">名字</label>
                            <input type="text" class="form-control" name="mbeForename" id="mbeForename">
                        </div>
                        <div class="mb-3">
                            <label for="mbeNickname" class="form-label">暱稱</label>
                            <input type="text" class="form-control" name="mbeNickname" id="mbeNickname">
                        </div>
                        <div class="mb-4">
                            <label for="mbeAccount" class="form-label">註冊信箱</label>
                            <input type="email" class="form-control" name="mbeAccount" id="mbeAccount" disabled>
                        </div>
                        <input class="form-check-input mb-4" type="radio" name="enable_disable" id="enable" value="1" onclick="confirmEnable(event)">
                        <label class="form-check-label" for="enable">
                            啟用
                        </label>
                        &nbsp&nbsp&nbsp
                        <input class="form-check-input mb-4" type="radio" name="enable_disable" id="disable" value="0" onclick="confirmDisable(event)">
                        <label class="form-check-label" for="disable">
                            停用
                        </label>
                        <br>
                        <button type="submit" class="btn btn-primary" id="mbe_button">確認送出</button>
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
<!-- confirm modal -->
<div class="modal" id="myModalConfirm" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modal_header_c">Modal Heading</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="modal_body_c">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="modal_footer_c1">確定</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="modal_footer_c2">取消</button>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/parts/scripts.php'; ?>

<script>
    //抓sid的url
    // reference: https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });

    // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"
    // let value = params.some_key; // "some_value"
    let value = params.sid;
    // console.log(value);

    //如果是sid是空值 會跳轉到list頁
    if (!value) {
        // <a href="05-mb_edit.php?sid=${member_sid}">
        location.href = '05-mb_list.php';
    }

    // =========一旦點編輯後 會自動帶入資料庫已存在的值==============

    retrieveForm();

    function retrieveForm() {
        const fd = new FormData();
        fd.append('sid', value);

        fetch('05-mb_edit_select_api.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                if (!obj.success) {
                    console.log(obj.error);
                } else {
                    let row = obj.row;
                    console.log(row);

                    document.querySelector("[name='sid']").value = row.member_sid;
                    document.querySelector("#mbeNum").value = row.member_sid;
                    document.querySelector("#mbeSurname").value = row.member_surname;
                    document.querySelector("#mbeForename").value = row.member_forename;
                    document.querySelector("#mbeNickname").value = row.member_nickname;
                    document.querySelector("#mbeAccount").value = row.member_email;
                    document.querySelector("#mbeAccount").value = row.member_email;
                    document.querySelector("#enable").checked = row.member_status === '1' ? true : false;
                    document.querySelector("#disable").checked = row.member_status === '0' ? true : false;
                    // console.log(row.member_status);
                    // console.log(typeof row.member_status);
                }
            })

    }

    const myModalLS = new bootstrap.Modal(document.getElementById('myModalSuccess'), {
        keyboard: false
    });

    const myModalLC = new bootstrap.Modal(document.getElementById('myModalConfirm'), {
        keyboard: false
    });

    // =========檢查form的資料 並且更新修改==============

    function checkForm() {
        const fd = new FormData(document.mbEditForm);

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
        // reference: Set the value of an input field: https://stackoverflow.com/questions/7609130/set-the-value-of-an-input-fi</a>eld
    }

    // =========radio的確認取消的鍵==============

    function confirmEnable(e) {
        e.preventDefault(); //在radio的時候就不會做事 再按確定和取消更不會坐視 所以改的時候不會更改他的狀態
        console.log(e.target); //<input class="form-check-input mb-4" type="radio" name="enable_disable" id="enable" value="1" onclick="confirmEnable(event)">
        console.log(e.target.value); //1

        myModalLC.show();
        document.querySelector('#modal_header_c').innerHTML = '啟用/停用';
        document.querySelector('#modal_body_c').innerHTML = '確定要啟用嗎?';
        document.querySelector('#modal_footer_c1').addEventListener('click', () => {
            // 設定畫面要變成甚麼樣子

            document.querySelector("#enable").checked = true;
            document.querySelector("#disable").checked = false;
            // document.querySelector("#enable").checked = e.target.value === '1' ? true : false;
            // document.querySelector("#disable").checked = e.target.value === '0' ? true : false;

            myModalLS.show();
            document.querySelector('#modal_header_s').innerHTML = '啟用/停用';
            document.querySelector('#modal_body_s').innerHTML = '啟用成功';
            document.querySelector('#modal_footer_s').addEventListener('click', () => {});
        })

    }

    function confirmDisable(e) {
        e.preventDefault();

        myModalLC.show();
        document.querySelector('#modal_header_c').innerHTML = '啟用/停用';
        document.querySelector('#modal_body_c').innerHTML = '確定要停用嗎?';
        document.querySelector('#modal_footer_c1').addEventListener('click', () => {

            document.querySelector("#enable").checked = false;
            document.querySelector("#disable").checked = true;
            // document.querySelector("#enable").checked = e.target.value === '1' ? true : false;
            // document.querySelector("#disable").checked = e.target.value === '0' ? true : false;

            myModalLS.show();
            document.querySelector('#modal_header_s').innerHTML = '啟用/停用';
            document.querySelector('#modal_body_s').innerHTML = '停用成功';
            // document.querySelector('#modal_footer_s').addEventListener('click', () => {});
        })

    }
</script>

<?php include __DIR__ . '/parts/html-foot.php'; ?>