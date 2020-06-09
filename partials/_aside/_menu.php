<?php
if(!isset($_SESSION)){
   session_start();
}
$a = $_SESSION['user_details']['role_id'];
//$a = 99;
?>
<style>
.kt-menu__toggle{
 background-color: #421E11 !important;
}

</style>
<input type="hidden" value="<?php if(isset($_GET['page'])){echo $_GET['page'];}?>" id="page">
<!-- begin:: Aside Menu -->
<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper" id="aside_menu">
	<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
		<ul class="kt-menu__nav ">
            <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/profile.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">الملف الشخصي</span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--danger kt-badge--inline">new</span></span></a></li>
            <li class="kt-menu__section ">
				<h4 class="kt-menu__section-text">احصائيات</h4>
				<i class="kt-menu__section-icon flaticon-more-v2"></i>
			</li>
            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open kt-menu__item--here" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-graphic"></i><span class="kt-menu__link-text">لوحة الاحصاء</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
				<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
					<ul class="kt-menu__subnav">
						<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Dashboards</span></span></li>

                        <li class="kt-menu__item" aria-haspopup="true"><a href="index.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">الاعداد الكلية</span></a></li>
                        <?php if($a == 3 || $a == 2 || $a == 1 || $a==99){?>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/numbers.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">اعداد الطلبة التفصيلية</span></a></li>
                        <?php } ?>
                    </ul>
				</div>
			</li>
			<li class="kt-menu__section ">
				<h4 class="kt-menu__section-text">اخرى</h4>
				<i class="kt-menu__section-icon flaticon-more-v2"></i>
			</li>
			           <?php if($a == 3 || $a == 1 || $a==99){?>
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">الملاك</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
							<div class="kt-menu__submenu kt-menu__item--open"><span class="kt-menu__arrow"></span>
								<ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Users</span></span></li>
                                <?php if($a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/accounter.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">مدير حسابات</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/hrManager.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">مدير الموارد البشرية</span></a></li>
                                 <?php } ?>
                                 <?php if($a == 3 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/branchManger.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">مدير فرع</span></a></li>
                                 <?php } ?>
                                 <?php if($a == 3 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/teacher.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">التدريسين</span></a></li>
                                 <?php } ?>
                                </ul>
							</div>
						</li>
                        <?php } ?>
						<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">الادارة</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
							<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
								<ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Profile</span></span></li>

                                <?php if($a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/branches.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">الافرع</span></a></li>
                                <?php }?>
                                <?php if($a == 4 ||  $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/timeTable.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">الجدول الاسبوعي</span></a></li>
                                <?php }?>
                                <?php if($a == 4 ||  $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/groups.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">المجموعات</span></a></li>
                                <?php }?>
                                <?php if($a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/levels.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">المستويات</span></a></li>
                                <?php }?>
                                <?php if($a == 4 || $a == 3 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/leave.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">اجازات الموظفين</span></a></li>
                                <?php }?>


                                </ul>
							</div>
						</li>
						<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">ادارة الطلاب</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
							<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
								<ul class="kt-menu__subnav">
                                <?php if($a == 4 || $a == 3 || $a == 2 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/students.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">اضافة وتعديل بيانات الطلاب</span></a></li>
                                <?php }?>
                                <?php if($a == 5 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/studentManagement.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">تقيم الطلاب</span></a></li>
                                <?php }?>
                                <?php if($a == 4 || $a == 3 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/studentLeave.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">اجازات الطلاب</span></a></li>
                                <?php }?>
                                <?php if($a == 2 || $a == 4 || $a == 3 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/showStudentLeave.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">عرض اجازات طالب</span></a></li>
                                <?php }?>
                                <?php if($a == 2 || $a == 4 || $a == 3 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/studentPenalty.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">غرامات الطلاب</span></a></li>
                                <?php }?>
                                </ul>
							</div>
						</li>
                        <?php if($a == 4 || $a == 2 || $a == 1 || $a==99){?>
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">المالبة</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
							<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
								<ul class="kt-menu__subnav">
									<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Profile</span></span></li>

                                <?php if($a == 2 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/salary.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">الرواتب</span></a></li>
                                <?php } ?>
                                <?php if( $a == 2 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/balance.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">كشف حساب</span></a></li>
                                <?php } ?>
                                <?php if($a == 4 || $a == 2 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/cash.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">النثريات</span></a></li>
                                <?php } ?>
                                <?php if($a == 4 || $a == 2 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/installment.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">اقساط الطلاب</span></a></li>
                                <?php } ?>
                                <?php if($a == 4 || $a == 2 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/moneyout.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">الصرفيات</span></a></li>
                                <?php } ?>
                                <?php if($a == 4 || $a == 2 || $a == 1 || $a==99){?>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="?page=pages/award.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">العقوبات والمكافئأت</span></a></li>
                                <?php } ?>
                                </ul>
							</div>
						</li>
                        <?php } ?>

		</ul>
	</div>
</div>
<script type="text/javascript">
page = $("#page").val();
if(page != ""){
$("#aside_menu i").removeClass("kt-menu__item--active");
$("[href='?page="+page+"']").parent().addClass("kt-menu__item--active");
}else{
$("[href='index.php']").parent().addClass("kt-menu__item--active");
}
</script>
<!-- end:: Aside Menu -->