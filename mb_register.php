<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/nav-bar_SY.php' ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 fw-bolder">填寫註冊資料</h5>

                    <!-- 表單填寫 -->
                    <form name="mbRegistForm" onsubmit="checkForm(); return false;">
                        <div class="mb-3">
                            <label for="mbrSurname" class="form-label">姓氏</label>
                            <input type="text" class="form-control" name="mbrSurname" id="mbrSurname">
                        </div>
                        <div class="mb-3">
                            <label for="mbrForename" class="form-label">名字</label>
                            <input type="text" class="form-control" name="mbrForename" id="mbrForename">
                        </div>
                        <div class="mb-3">
                            <label for="mbrNickname" class="form-label">暱稱</label>
                            <input type="text" class="form-control" name="mbrNickname" id="mbrNickname">
                        </div>
                        <div class="mb-3">
                            <label for="mbrEmail" class="form-label">註冊信箱</label>
                            <input type="email" class="form-control" name="mbrEmail" id="mbrEmail">
                        </div>
                        <div class="mb-3">
                            <label for="mbrPassword" class="form-label">註冊密碼</label>
                            <input type="password" class="form-control" name="mbrPassword" id="mbrPassword">
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" name="mbrCheck" id="mbrCheck" >
                            <label class="form-check-label" for="mbrCheck">我同意 <a href="https://drive.google.com/file/d/1RCTH1c06K3D6d6oLE1DIUzG-2ONVitzX/view" target="_blank">惜食戰士條款</a></label>
                        </div>
                        <button type="submit" class="btn btn-primary">立即註冊</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- reference: https://www.momoshop.com.tw/customer/CustomerInput.jsp -->


<?php include __DIR__ . '/parts/scripts.php' ?>

<script>
    function checkForm() {
        const fd_r = new FormData(document.mbRegistForm);

        fetch('mb_register_api.php', {
            method: 'POST',
            body: fd_r,
        })
        .then(r => r.json())
        .then(obj_r => {
            console.log(obj_r);
        })

    }
</script>

<?php include __DIR__ . '/parts/html-foot.php' ?>