

function dispbill()
{

   document.getElementById('o-div2').style.display="block";

}


document.querySelector('#can_btn').onclick = () =>{
   document.querySelector('.updatepsec').style.display = 'none';
   window.location.href = 'admin_products.php';

}

document.querySelector('#can_btn').onclick = () =>{
   document.querySelector('.reordersec').style.display = 'none';

   window.location.href = 'inventory.php';
}
