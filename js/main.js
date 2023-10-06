const navItems = document.querySelector('.nav__items');
const OpenNavBtn = document.querySelector('#open_nav-btn');
const CloseNavBtn = document.querySelector('#close_nav-btn');
//opens nav dropdown
const openNav =()=>{
    navItems.style.display='flex';
    OpenNavBtn.style.display='none';
    CloseNavBtn.style.display='inline-block';
}
OpenNavBtn.addEventListener('click',openNav);
const closeNav= () =>{
    navItems.style.display='none';
    OpenNavBtn.style.display='inline-block';
    CloseNavBtn.style.display='none';
}
OpenNavBtn.addEventListener('click',openNav);
CloseNavBtn.addEventListener('click',closeNav);

const sidebar= document.querySeIector('aside');
const showSidebarBtn =document.querySeIector( '#show__sidebar-btn' );
const hideSidebarBtn =document.queryselector('#hide__sidebar-btn');
// shows sidebar on small devices
const showSidebar = ()=> {
    sidebar.style.left ='0';
    showSidebarBtn.style.display = 'none';
    hideSidebarBtn.style.display ='inline-block';
}
    // hide sidebar on small devices
    const hideSidebar =()=>{
    sidebar.style.left='-100%';
    showSidebarBtn.style.display='inline-block';
    hideSidebarBtn.style.display='none';
    }
showSidebarBtn.addEventListener('click',showSidebar)