function dispbill()
{

   document.getElementById('o-div2').style.display="block";

}
function showreview(arg)
{
    select_value= arg.value;
    document.getElementById('item_name').innerHTML= select_value;
    document.getElementById('hname').value=select_value;
    document.getElementById('reviewdiv').style.display="block";
   window.scrollBy(1000,2000);
}