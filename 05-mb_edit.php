<?php include __DIR__ . '/parts/connect_db.php';

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


?>

<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/05-nav-bar-admin.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 fw-bolder">基本資料修改</h5>

                    <form name="mbEditForm" onsubmit="checkForm(); return false;">
                        <input type="hidden" name="sid" value="<?= $r['member_sid'] ?>">
                        <div class="mb-3">
                            <label for="mbeNum" class="form-label">會員編號</label>
                            <input type="text" class="form-control" name="mbeNum" id="mbeNum" value="<?= $r['member_sid'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="mbeSurname" class="form-label">姓氏</label>
                            <input type="text" class="form-control" name="mbeSurname" id="mbeSurname" value="<?= htmlentities($r['member_surname']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="mbeForename" class="form-label">名字</label>
                            <input type="text" class="form-control" name="mbeForename" id="mbeForename" value="<?= htmlentities($r['member_forename']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="mbeNickname" class="form-label">暱稱</label>
                            <input type="text" class="form-control" name="mbeNickname" id="mbeNickname" value="<?= htmlentities($r['member_nickname']) ?>">
                        </div>
                        <div class="mb-4">
                            <label for="mbeAccount" class="form-label">註冊信箱</label>
                            <input type="email" class="form-control" name="mbeAccount" id="mbeAccount" value="<?= $r['member_email'] ?>" disabled>
                        </div>
                        <input class="form-check-input mb-4" type="radio" name="enable_disable" id="enable" value="1" <?= $r['member_status'] == '1' ? 'checked' : '' ?> onclick="return confirm('確定要啟用帳號嗎?')">
                        <label class="form-check-label" for="enable">
                            啟用
                        </label>
                        &nbsp&nbsp&nbsp
                        <input class="form-check-input mb-4" type="radio" name="enable_disable" id="disable" value="0" <?= $r['member_status'] == '0' ? 'checked' : '' ?> onclick="return confirm('確定要停用帳號嗎?')">
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
<?php /*$r['member_status'] = ('0' ? 'checked' : '') */ ?>
<?php /*print_r($_POST); */ ?>
<?php /*echo $r['member_email'] */ ?>
<?php /*echo $r['member_status']  */ ?>


<?php include __DIR__ . '/parts/scripts.php'; ?>

<script>
    function checkForm() {
        const fd = new FormData(document.mbEditForm);

        for (let k of fd.keys()) {
            // keys = An object that can be iterated over 可迭代
            console.log(`${k}: ${fd.get(k)}`);
        }

        // TODO: 檢查欄位資料

        fetch('05-mb_edit_api.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (!obj.success) {
                    alert(obj.error);
                } else {
                    alert('修改成功');
                    location.href = '05-mb_list.php';
                }
            })

    }
</script>

<?php include __DIR__ . '/parts/html-foot.php'; ?>