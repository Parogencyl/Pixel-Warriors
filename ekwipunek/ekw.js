//

document.querySelector('#tools1').style.visibility = 'hidden';
document.querySelector('#tools2').style.visibility = 'hidden';
document.querySelector('#tools3').style.visibility = 'hidden';

function openMenu(number) {
    document.querySelector('.tooltipItem' + number + 'Eq').style.visibility = 'hidden'
    document.querySelector('#tools' + number).style.visibility = 'visible';
}

function compare(number) {
    document.querySelector('#tools' + number).style.visibility = 'hidden';
    document.querySelector('.tooltipItem' + number + 'Eq').style.visibility = 'visible';
    document.querySelector('.tooltipItem' + number).style.visibility = 'visible';
}

function sell(number) {
    document.querySelector('#tools' + number).style.visibility = 'visible';

}