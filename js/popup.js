let holderDeleteName;

function confirm_test(formName) { // 削除ボタンをクリックした場合
    document.getElementById('popup').style.display = 'block';
    document.getElementById('grayCover').style.display = 'block';
    holderDeleteName = formName;
    console.log(typeof(formName));

    return false;
}
 
function okfunc() { // OKをクリックした場合
    document.getElementById(holderDeleteName).submit();
}
 
function nofunc() { // キャンセルをクリックした場合
    document.getElementById('popup').style.display = 'none';
    document.getElementById('grayCover').style.display = 'none';
}