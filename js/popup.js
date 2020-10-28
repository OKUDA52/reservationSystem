let holderDeleteName;

function confirm_test(formName) { // 問い合わせるボタンをクリックした場合
    document.getElementById('popup').style.display = 'block';
    holderDeleteName = formName;
    console.log(typeof(formName));

    return false;
}
 
function okfunc() { // OKをクリックした場合
    document.getElementById(holderDeleteName).submit();
}
 
function nofunc() { // キャンセルをクリックした場合
    document.getElementById('popup').style.display = 'none';
}