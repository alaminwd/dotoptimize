<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SeoTagController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/service', [FrontendController::class, 'service'])->name('service');
Route::get('/project', [FrontendController::class, 'project'])->name('project');
Route::get('/product', [FrontendController::class, 'product'])->name('product');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/company', [FrontendController::class, 'company'])->name('company');
Route::get('/career', [FrontendController::class, 'career'])->name('career');
Route::get('/policy', [FrontendController::class, 'policy'])->name('policy');
Route::get('/how/work', [FrontendController::class, 'how_work'])->name('how.work');
Route::get('/case/studiy', [FrontendController::class, 'case_studiy'])->name('case.studiy');
Route::get('/testimonial', [FrontendController::class, 'testimonial'])->name('testimonial');
Route::get('/plan', [FrontendController::class, 'plan'])->name('plan');
Route::get('/service/single/{service_id}', [FrontendController::class, 'single_service'])->name('single.service');
Route::get('/project/single/{project_id}', [FrontendController::class, 'single_project'])->name('single.project');
Route::get('/product/single/{product_id}', [FrontendController::class, 'single_product'])->name('single.product');
Route::get('/team/single/{team_id}', [FrontendController::class, 'single_member'])->name('single.member');
Route::get('/blog/single/{blog_id}', [FrontendController::class, 'single_blog'])->name('single.blog');
Route::get('/blog/category/{category_id}', [FrontendController::class, 'category_blog'])->name('category.blog');

Route::get('/tag/single/blog/{tag_id}', [FrontendController::class, 'tag_single_blog'])->name('tag.single.blog');
// Search Controller //
Route::get('/search',[BlogController::class , 'search'])->name('search');

// ========Cart==========//
Route::get('/cart/{plan_id}',[CartController::class, 'cart'])->name('cart');

Route::post('/chekout', [CartController::class, 'chekout'])->name('chekout');


// Home Controller
Auth::routes();
Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware('auth');
Route::get('/admin/logout', [HomeController::class, 'admin_logout'])->name('admin.logout');


// User Controller
Route::post('/admin/register/',[UserController::class, 'admin_register'])->name('admin.register') ->middleware('auth');
Route::get('/user', [UserController::class, 'user'])->name('user')->middleware('auth');
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete')->middleware('auth');
Route::get('/user/proflie', [UserController::class, 'user_profile'])->name('user.profile')->middleware('auth');
Route::post('/user/proflie/update', [UserController::class, 'profile_update'])->name('profile.update')->middleware('auth');
Route::post('/user/password/update', [UserController::class, 'password_update'])->name('password.update')->middleware('auth');
Route::post('/user/photo/update', [UserController::class, 'photo_update'])->name('photo.update')->middleware('auth');


// Navbar controller
Route::get('/navbar/logo', [NavController::class, 'nav_logo'])->name('nav.logo')->middleware('auth');
Route::post('/navbar/logo/store', [NavController::class, 'logo_store'])->name('logo.store')->middleware('auth');
Route::get('/navbar/logo/delete/{logo_id}', [NavController::class, 'logo_delete'])->name('logo.delete')->middleware('auth');
Route::get('/navbar/logo/status/{logo_id}', [NavController::class, 'logo_status'])->name('logo.status')->middleware('auth');

// Navbar Menu controller
Route::get('/navbar/menu', [NavController::class, 'nav_menu'])->name('nav.menu')->middleware('auth');
Route::post('/navbar/menu/store', [NavController::class, 'menu_store'])->name('menu.store')->middleware('auth');
Route::get('/navbar/menu/delete/{menu_id}', [NavController::class, 'menu_delete'])->name('menu.delete')->middleware('auth');
Route::get('/navbar/menu/eidt/{menu_id}', [NavController::class, 'menu_edit'])->name('menu.edit')->middleware('auth');
Route::post('/navbar/menu/update/', [NavController::class, 'menu_update'])->name('menu.update')->middleware('auth');


// Banner 
Route::get('/banner', [NavController::class, 'banner'])->name('banner')->middleware('auth');
Route::post('/banner/update', [NavController::class, 'banner_update'])->name('banner.update')->middleware('auth');

// About Controller
Route::get('/about/info', [AboutController::class, 'about_info'])->name('about.info')->middleware('auth');
Route::post('/about/update', [AboutController::class, 'about_update'])->name('about.update')->middleware('auth');
Route::get('/about/client', [AboutController::class, 'client'])->name('client')->middleware('auth');
Route::post('/client/store', [AboutController::class, 'client_store'])->name('client.store')->middleware('auth');
Route::get('/about/client/delete/{client_id}', [AboutController::class, 'client_delete'])->name('client.delete')->middleware('auth');

// About Skill Controller
Route::get('/about/skill', [AboutController::class, 'skill'])->name('skill')->middleware('auth');
Route::post('/about/skill/store', [AboutController::class, 'skill_store'])->name('skill.store')->middleware('auth');
Route::get('/about/skill/delete/{skill_id}', [AboutController::class, 'skill_delete'])->name('skill.delete')->middleware('auth');
Route::get('/about/skill/edit/{skill_id}', [AboutController::class, 'skill_edit'])->name('skill.edit')->middleware('auth');
Route::post('/about/skill/update', [AboutController::class, 'skill_update'])->name('skill.update')->middleware('auth');

// About Work Controller
Route::get('/work', [AboutController::class, 'work'])->name('work')->middleware('auth');
Route::post('/work/update', [AboutController::class, 'work_update'])->name('work.update')->middleware('auth');

// About Copany Overview Controller
Route::get('/overview', [AboutController::class, 'overview'])->name('overview')->middleware('auth');
Route::post('/overview/update', [AboutController::class, 'overview_update'])->name('overview.update')->middleware('auth');

// Member Team Controller
Route::get('/member', [TeamController::class, 'member'])->name('member')->middleware('auth');
Route::get('/add/member/section', [TeamController::class, 'member_section_title'])->name('member.section.title')->middleware('auth');
Route::post('/update/section/title', [TeamController::class, 'team_title_update'])->name('team.title.update')->middleware('auth');


Route::post('/member/store', [TeamController::class, 'member_store'])->name('member.store')->middleware('auth');
Route::get('/member/list', [TeamController::class, 'member_list'])->name('member.list')->middleware('auth');
Route::get('/member/delete/{member_id}', [TeamController::class, 'member_delete'])->name('member.delete')->middleware('auth');
Route::get('/member/edit/{member_id}', [TeamController::class, 'member_edit'])->name('member.edit')->middleware('auth');
Route::post('/member/update', [TeamController::class, 'member_update'])->name('member.update')->middleware('auth');

// Member Skill Team Controller
Route::get('/member/skill', [TeamController::class, 'member_skill'])->name('member.skill')->middleware('auth');
Route::post('/member/skill/store', [TeamController::class, 'member_skill_store'])->name('member.skill.store')->middleware('auth');
Route::get('/member/skill/delete/{skill_id}', [TeamController::class, 'member_skill_delete'])->name('member.skill.delete')->middleware('auth');
Route::get('/member/skill/edit/{skill_id}', [TeamController::class, 'member_skill_edit'])->name('member.skill.edit')->middleware('auth');
Route::post('/member/skill/update', [TeamController::class, 'member_skill_update'])->name('member.skill.update')->middleware('auth');


// Member Icon Team Controller
Route::get('/member/icon', [TeamController::class, 'member_icon'])->name('member.icon')->middleware('auth');
Route::post('/member/icon/store', [TeamController::class, 'member_icon_store'])->name('member.icon.store')->middleware('auth');
Route::get('/member/icon/delete/{icon_id}', [TeamController::class, 'member_icon_delete'])->name('member.icon.delete')->middleware('auth');
Route::get('/member/icon/edit/{icon_id}', [TeamController::class, 'member_icon_edit'])->name('member.icon.edit')->middleware('auth');
Route::post('/member/icon/update', [TeamController::class, 'member_icon_update'])->name('member.icon.update')->middleware('auth');

// Testimonialcontroller
Route::get('/add/review', [ReviewController::class, 'add_review'])->name('add.review')->middleware('auth');
Route::post('/review/store', [ReviewController::class, 'review_store'])->name('review.store')->middleware('auth');
Route::post('/review/update', [ReviewController::class, 'review_update'])->name('review.update')->middleware('auth');
Route::get('/review/delete/{review_id}', [ReviewController::class, 'review_delete'])->name('review.delete')->middleware('auth');
Route::get('/review/edit/{review_id}', [ReviewController::class, 'review_edit'])->name('review.edit')->middleware('auth');
Route::get('/testimonial/content/', [ReviewController::class, 'testimonial_content'])->name('testimonial.content')->middleware('auth');
Route::post('/testimonial/content/update/', [ReviewController::class, 'testimonial_content_update'])->name('testimonial.content.update')->middleware('auth');




// Category controller
Route::get('/add/category', [BlogController::class, 'add_category'])->name('add.category')->middleware('auth');
Route::post('/category/store', [BlogController::class, 'category_store'])->name('category.store')->middleware('auth');
Route::get('/category/delete/{category_id}', [BlogController::class, 'category_delete'])->name('category.delete')->middleware('auth');
Route::get('/category/edit/{category_id}', [BlogController::class, 'category_edit'])->name('category.edit')->middleware('auth');
Route::post('/category/update', [BlogController::class, 'category_update'])->name('category.update')->middleware('auth');
Route::get('/blog/comment/delete/{comment_id}', [BlogController::class, 'comment_delete'])->name('comment.delete')->middleware('auth');
Route::get('/blog/comment/reply/{comment_id}', [BlogController::class, 'comment_reply'])->name('comment.reply')->middleware('auth');
Route::post('/blog/comment/reply/store', [BlogController::class, 'comment_reply_store'])->name('comment.reply.store')->middleware('auth');

// Category Tag controller
Route::get('/add/tag', [BlogController::class, 'add_tag'])->name('add.tag')->middleware('auth');
Route::post('/tag/store', [BlogController::class, 'tag_store'])->name('tag.store')->middleware('auth');
Route::get('/tag/delete/{tag_id}', [BlogController::class, 'tag_delete'])->name('tag.delete')->middleware('auth');
Route::get('/comment', [BlogController::class, 'comment'])->name('comment');
Route::post('/comment/submite', [BlogController::class, 'comment_store'])->name('comment.store');

//  blog controller
Route::get('/blog/add', [BlogController::class, 'add_blog'])->name('add.blog')->middleware('auth');
Route::post('/blog/store', [BlogController::class, 'blog_store'])->name('blog.store')->middleware('auth');
Route::get('/blog/list', [BlogController::class, 'blog_list'])->name('blog.list')->middleware('auth');
Route::get('/blog/delete/{blog_id}', [BlogController::class, 'blog_delete'])->name('blog.delete')->middleware('auth');
Route::get('/blog/tag/{blog_id}', [BlogController::class, 'blog_tag'])->name('blog.tag')->middleware('auth');
Route::post('/blog/tag/store', [BlogController::class, 'blog_tag_store'])->name('blog.tag.store')->middleware('auth');
Route::get('/blog/tag/delete/{tag_id}', [BlogController::class, 'blog_tag_delete'])->name('blog.tag.delete')->middleware('auth');

//  Service controller
Route::get('/add/service', [ServiceController::class, 'add_service'])->name('add.service')->middleware('auth');
Route::post('/service/store', [ServiceController::class, 'service_store'])->name('service.store')->middleware('auth');
Route::get('/service/list', [ServiceController::class, 'service_list'])->name('service.list')->middleware('auth');
Route::get('/service/delete/{ser_id}', [ServiceController::class, 'service_delete'])->name('service.delete')->middleware('auth');
Route::get('/service/edit/{ser_id}', [ServiceController::class, 'service_edit'])->name('service.edit')->middleware('auth');
Route::post('/service/update', [ServiceController::class, 'service_update'])->name('service.update')->middleware('auth');
Route::get('/service/plan/{ser_id}', [ServiceController::class, 'service_plan'])->name('service.plan')->middleware('auth');
Route::post('/add/service/plan', [ServiceController::class, 'add_service_plan'])->name('add.service.plan')->middleware('auth');
Route::get('/service/price/delete/{ser_id}', [ServiceController::class, 'service_price_delete'])->name('service.price.delete')->middleware('auth');

//  Price controller
Route::get('/add/plan', [PriceController::class, 'add_plan'])->name('add.plan')->middleware('auth');
Route::post('/plan/store', [PriceController::class, 'plan_store'])->name('plan.store')->middleware('auth');
Route::get('/plan/status/{plan_id}', [PriceController::class, 'plan_status'])->name('plan.status')->middleware('auth');
Route::get('/plan/delete/{plan_id}', [PriceController::class, 'plan_delete'])->name('plan.delete')->middleware('auth');
Route::get('/plan/edit/{plan_id}', [PriceController::class, 'plan_edit'])->name('plan.edit')->middleware('auth');
Route::post('/plan/update', [PriceController::class, 'plan_update'])->name('plan.update')->middleware('auth');
Route::get('/plan/features/{plan_id}', [PriceController::class, 'plan_features'])->name('plan.features')->middleware('auth');
Route::post('/feature/store', [PriceController::class, 'feature_store'])->name('feature.store')->middleware('auth');
Route::get('/features/delete/{feature_id}', [PriceController::class, 'feature_delete'])->name('feature.delete')->middleware('auth');
Route::get('/features/edit/{feature_id}', [PriceController::class, 'feature_edit'])->name('feature.edit')->middleware('auth');
Route::post('/features/update', [PriceController::class, 'feature_update'])->name('feature.update')->middleware('auth');

// ==========Order Controller=============//
Route::get('/order',[OrderController::class, 'order'])->name('order')->middleware('auth');;
Route::get('/order/delete/{order_id}',[OrderController::class, 'order_delete'])->name('order.delete')->middleware('auth');;
Route::post('/status',[OrderController::class, 'status_update'])->name('status.update')->middleware('auth');
Route::get('/order/success/',[OrderController::class, 'order_success'])->name('order.success'); //frontend 



// Project controller
Route::get('/add/project', [ProjectController::class, 'add_project'])->name('add.project')->middleware('auth');
Route::get('/add/project/section/title', [ProjectController::class, 'project_section_title'])->name('project.section.title')->middleware('auth');
Route::post('/update/product/section/title',[ProjectController::class, 'section_title_update'])->name('section.title.update')->middleware('auth');
Route::post('/project/store', [ProjectController::class, 'project_store'])->name('project.store')->middleware('auth');
Route::get('/project/list', [ProjectController::class, 'project_list'])->name('project.list')->middleware('auth');
Route::get('/project/delete/{project_id}', [ProjectController::class, 'project_delete'])->name('project.delete')->middleware('auth');

Route::get('/project/edit/{project_id}', [ProjectController::class, 'project_edit'])->name('project.edit')->middleware('auth');
Route::post('/project/update/', [ProjectController::class, 'project_update'])->name('project.update')->middleware('auth');
Route::get('/project/price/{project_id}', [ProjectController::class, 'project_price'])->name('project.price')->middleware('auth');
Route::post('/project/plan/store', [ProjectController::class, 'project_plan_store'])->name('project.plan.store')->middleware('auth');
Route::get('/project/plan/delete/{plan_id}', [ProjectController::class, 'project_plan_delete'])->name('project.plan.delete')->middleware('auth');

// Product controller
Route::get('/add/product', [Productcontroller::class, 'add_product'])->name('add.product')->middleware('auth');
Route::post('/product/store', [Productcontroller::class, 'product_store'])->name('product.store')->middleware('auth');
Route::get('/product/list', [Productcontroller::class, 'product_list'])->name('product.list')->middleware('auth');
Route::get('/product/edit/{product_id}', [Productcontroller::class, 'product_edit'])->name('product.edit')->middleware('auth');
Route::post('/product/update/', [Productcontroller::class, 'product_update'])->name('product.update')->middleware('auth');
Route::get('/product/delete/{product_id}', [Productcontroller::class, 'product_delete'])->name('product.delete')->middleware('auth');
Route::get('/product/price/{product_id}', [Productcontroller::class, 'product_price'])->name('product.price')->middleware('auth');
Route::post('/product/plan/store', [Productcontroller::class, 'product_plan_store'])->name('product.plan.store')->middleware('auth');
Route::get('/product/plan/delete/{plan_id}', [Productcontroller::class, 'product_plan_delete'])->name('product.plan.delete')->middleware('auth');
Route::get('/product/section/title', [Productcontroller::class, 'product_section_title'])->name('product.section.title')->middleware('auth');
Route::post('/product/section/info/update', [Productcontroller::class, 'product_section_info_update'])->name('product.section.info.update')->middleware('auth');


// =======Careers Part ============//
Route::get('add/job/post/',[CareersController::class, 'job_post'])->name('job.post')->middleware('auth');
Route::post('/job/store/',[CareersController::class, 'post_store'])->name('post.store')->middleware('auth');
Route::get('/job/post/delete/{post_id}',[CareersController::class, 'post_delete'])->name('post.delete')->middleware('auth');
Route::get('/job/post/details/{post_id}',[CareersController::class, 'post_details'])->name('post.details');
Route::post('/applicant/upload/cv/',[CareersController::class, 'upload_cv'])->name('upload.cv');
Route::get('/applicant/list/',[CareersController::class, 'applicant'])->name('applicant')->middleware('auth');
Route::get('/applicant/delete/{applicant_id}',[CareersController::class, 'applicant_delete'])->name('applicant.delete')->middleware('auth');
Route::get('/download/applicant/cv/{applicant_id}',[CareersController::class, 'download_cv'])->name('download.cv')->middleware('auth');




// Gallery controller
Route::get('/add/gallery', [GalleryController::class, 'add_gallery'])->name('add.gallery')->middleware('auth');
Route::post('/gallery/store', [GalleryController::class, 'gallery_store'])->name('gallery.store')->middleware('auth');
Route::get('/gallery/delete/{gal_id}', [GalleryController::class, 'gallery_delete'])->name('gallery.delete')->middleware('auth');

// Footer Info
Route::get('/footer/request/title', [FooterController::class, 'add_title'])->name('add.title')->middleware('auth');
Route::post('/footer/request/title/update', [FooterController::class, 'update_title'])->name('title.update')->middleware('auth');
Route::get('/footer/info', [FooterController::class, 'footer_info'])->name('footer.info')->middleware('auth');
Route::post('/footer/update', [FooterController::class, 'footer_update'])->name('footer.update')->middleware('auth');
Route::post('/footer/icon/store', [FooterController::class, 'footer_icon_store'])->name('footer.icon.store')->middleware('auth');
Route::get('/footer/icon/delete/{icon_id}', [FooterController::class, 'footer_icon_delete'])->name('footer.icon.delete')->middleware('auth');
Route::get('/footer/icon/edit/{icon_id}', [FooterController::class, 'footer_icon_edit'])->name('footer.icon.edit')->middleware('auth');
Route::post('/footer/icon/update', [FooterController::class, 'footer_icon_update'])->name('footer.icon.update')->middleware('auth');
Route::get('/work/way', [FooterController::class, 'work_way'])->name('work.way')->middleware('auth');
Route::post('/work/way/store', [FooterController::class, 'work_way_store'])->name('work.way.store')->middleware('auth');
Route::get('/work/way/delete/{work_id}', [FooterController::class, 'work_way_delete'])->name('work.way.delete')->middleware('auth');
Route::post('/work/way/update/', [FooterController::class, 'update_work_way'])->name('update.work.way')->middleware('auth');
Route::get('provide/info',[FooterController::class, 'provide_info'])->name('provide.info');
Route::post('/store/provide/info/',[FooterController::class, 'store_info'])->name('store.info');
Route::get('/view/customer/provide/information',[FooterController::class, 'customer_provide_info'])->name('customer.provide.info');
Route::get('/update/provide/information/{id}',[FooterController::class, 'update_provide_info'])->name('update.provide.info');
Route::post('/update/provide/details/',[FooterController::class, 'provide_edit'])->name('provide.edit');
Route::get('/provide/info/delete/{id}',[FooterController::class, 'provide_info_delete'])->name('provide.info.delete');


Route::get('/edit/policy', [FooterController::class, 'edit_policy'])->name('edit.policy')->middleware('auth');
Route::post('/update/policy', [FooterController::class, 'policy_update'])->name('policy.update')->middleware('auth');

Route::get('/update/footer/copyright/', [FooterController::class, 'copyright'])->name('copyright')->middleware('auth');
Route::post('/update/footer/copyright/content/', [FooterController::class, 'copyright_content_update'])->name('copyright.content.update')->middleware('auth');


// Quote Contact controller
Route::post('/quote/store', [ContactController::class, 'quote_store'])->name('quote.store');
Route::get('/quote/list', [ContactController::class, 'quote_list'])->name('quote.list')->middleware('auth');
Route::get('/quote/delete/{quote_id}', [ContactController::class, 'Quote_delete'])->name('Quote.delete')->middleware('auth');
Route::get('/quote/view/{quote_id}', [ContactController::class, 'Quote_view'])->name('Quote.view')->middleware('auth');
Route::get('/contact/content/', [ContactController::class, 'contact_content'])->name('contact.content')->middleware('auth');
Route::post('/contact/content/update/', [ContactController::class, 'update_content'])->name('update.content')->middleware('auth');
Route::post('/add/address/info/', [ContactController::class, 'add_address'])->name('add.address')->middleware('auth');
Route::get('/delete/address/{address_id}', [ContactController::class, 'delete_address'])->name('delete.address')->middleware('auth');




// Message Contact controller
Route::post('/message/store', [ContactController::class, 'message_store'])->name('message.store');
Route::get('/message/list', [ContactController::class, 'message_list'])->name('message.list')->middleware('auth');
Route::get('/message/delete/{message_id}', [ContactController::class, 'message_delete'])->name('message.delete')->middleware('auth');
Route::get('/message/view/{message_id}', [ContactController::class, 'message_view'])->name('message.view')->middleware('auth');


// Message Contact controller
Route::post('/contact/store', [ContactController::class, 'contact_store'])->name('contact.store');
Route::get('/contact/list', [ContactController::class, 'contact_list'])->name('contact.list')->middleware('auth');
Route::get('/contact/delete/{message_id}', [ContactController::class, 'contact_delete'])->name('contact.delete')->middleware('auth');
Route::get('/contact/view/{message_id}', [ContactController::class, 'contact_view'])->name('contact.view')->middleware('auth');


// Subscription Contact controller
Route::post('/subscribe/store', [ContactController::class, 'subscribe'])->name('subscribe');
Route::post('/banner/subscribe/store', [ContactController::class, 'subscribe_banner'])->name('subscribe.banner');
Route::get('/subscribe/list', [ContactController::class, 'subscribe_list'])->name('subscribe.list')->middleware('auth');
Route::get('/subscribe/delete/{subscribe_id}', [ContactController::class, 'subscribe_delete'])->name('subscribe.delete')->middleware('auth');
Route::get('/call/for/more/information/', [ContactController::class, 'call_information'])->name('call.information')->middleware('auth');
Route::post('/update/call/for/more/information/', [ContactController::class, 'update_call_info'])->name('update.call.info')->middleware('auth');


// ===========SEO============//
Route::get('/home/seo',[SeoTagController::class, 'home_seo'])->name('home.seo')->middleware('auth');
Route::post('/home/seo/store',[SeoTagController::class, 'home_seo_store'])->name('home.seo.store')->middleware('auth');
Route::get('/about/seo',[SeoTagController::class, 'about_seo'])->name('about.seo')->middleware('auth');
Route::post('/about/seo/store',[SeoTagController::class, 'about_seo_store'])->name('about.seo.store')->middleware('auth');
Route::get('/service/seo',[SeoTagController::class, 'service_seo'])->name('service.seo')->middleware('auth');
Route::post('/service/seo/store',[SeoTagController::class, 'service_seo_store'])->name('service.seo.store')->middleware('auth');
Route::get('/project/seo',[SeoTagController::class, 'project_seo'])->name('project.seo')->middleware('auth');
Route::post('/project/seo/store',[SeoTagController::class, 'project_seo_store'])->name('project.seo.store')->middleware('auth');
Route::get('/product/seo',[SeoTagController::class, 'product_seo'])->name('product.seo')->middleware('auth');
Route::post('/product/seo/store',[SeoTagController::class, 'product_seo_store'])->name('product.seo.store')->middleware('auth');
Route::get('/blog/seo',[SeoTagController::class, 'blog_seo'])->name('blog.seo')->middleware('auth');
Route::post('/blog/seo/store',[SeoTagController::class, 'blog_seo_store'])->name('blog.seo.store')->middleware('auth');
Route::get('/career/seo/',[SeoTagController::class, 'career_seo'])->name('career.seo')->middleware('auth');
Route::post('/career/seo/store/',[SeoTagController::class, 'career_seo_store'])->name('career.seo.store')->middleware('auth');
Route::get('/press/media/seo/',[SeoTagController::class, 'press_media_seo'])->name('press.media.seo')->middleware('auth');
Route::post('/prss/media/seo/store/',[SeoTagController::class, 'press_media_seo_store'])->name('press.media.seo.store')->middleware('auth');
Route::get('/company/seo/',[SeoTagController::class, 'company_seo'])->name('company.seo')->middleware('auth');
Route::post('/company/seo/update',[SeoTagController::class, 'company_seo_store'])->name('company.seo.store')->middleware('auth');
Route::get('/privacy/seo/store/',[SeoTagController::class, 'privacy_policy_seo'])->name('privacy.policy.seo')->middleware('auth');
Route::post('/privacy/seo/update/',[SeoTagController::class, 'privacy_seo_update'])->name('privacy.seo.update')->middleware('auth');
Route::get('/career/job/field/',[SeoTagController::class, 'career_job_sub'])->name('career.job.sub')->middleware('auth');
Route::post('/career/job/field/seo/update',[SeoTagController::class, 'job_seo_store'])->name('job.seo.store')->middleware('auth');
Route::get('/case/studies/seo/',[SeoTagController::class, 'case_studies_seo'])->name('case.studies.seo')->middleware('auth');
Route::post('/case/studies/seo/store/',[SeoTagController::class, 'case_studies_seo_store'])->name('case.studies.seo.store')->middleware('auth');
Route::get('/how/it/work/seo/',[SeoTagController::class, 'how_it_work_seo'])->name('how.it.work.seo')->middleware('auth');
Route::post('/how/it/work/seo/store/',[SeoTagController::class, 'how_it_work_seo_store'])->name('how.it.work.seo.store')->middleware('auth');




// =========Customer Login And Register ==============//
Route::get('/customer/login',[CustomerController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/register',[CustomerController::class, 'customer_register'])->name('customer.register');
Route::post('/customer/register/store',[CustomerController::class, 'register_store'])->name('customer.store');
Route::post('/customer/login/info',[CustomerController::class, 'customer_login_info'])->name('customer.login.info');
Route::get('/customer/logout/',[CustomerController::class, 'customer_logout'])->name('customer.logout');
Route::get('/customer/profile/',[CustomerController::class, 'customer_profile'])->name('customer.profile');
Route::post('/customer/profile/update/',[CustomerController::class, 'customer_profile_update'])->name('customer.profile.update');
Route::get('/customer/order/history/',[CustomerController::class, 'order_history'])->name('order.history');
Route::get('/customer/list/',[CustomerController::class, 'customer'])->name('customer');
Route::get('/customer/list/{customer_id}',[CustomerController::class, 'customer_delete'])->name('customer.delete');
Route::get('/purchase/plan/from/dashbosr/',[CustomerController::class, 'pay'])->name('pay');
Route::post('/purchase/info/store/',[CustomerController::class, 'payment_store'])->name('payment.store');

// password reset

Route::get('/customer/forgate/password/',[CustomerController::class, 'check_email'])->name('check.email');
Route::post('/customer/password/request/send/',[CustomerController::class, 'password_request_send'])->name('password.request.send');
Route::get('/pass/reset/form/{token}',[CustomerController::class, 'pass_reset_form'])->name('pass.reset.form');
Route::post('/pass/reset/confirm/',[CustomerController::class, 'password_reset_confirm'])->name('password.reset.confirm');



Route::get('/customer/support/',[CustomerController::class, 'support'])->name('support'); //frontend
Route::post('/customer/support/request',[CustomerController::class, 'support_request'])->name('support.request'); //frontend
Route::get('/customer/support/details',[CustomerController::class, 'customer_support'])->name('customer.support')->middleware('auth'); //backend
Route::get('/customer/file/download/{support_id}',[CustomerController::class, 'document_file_download'])->name('document.file.download')->middleware('auth'); //backend
Route::get('/customer/support/info/delete/{support_id}',[CustomerController::class, 'support_info_delete'])->name('support.info.delete')->middleware('auth'); //backend
Route::get('/customer/support/details/{support_id}',[CustomerController::class, 'support_details'])->name('support.details')->middleware('auth'); //backend


// Customer Email Verify 
Route::get('/customer/email/verify/{customer_id}/{token}',[CustomerController::class, 'customer_email_verify'])->name('customer.email.verify'); //frontend
Route::get('/customer/again/email/verify/',[CustomerController::class, 'again_verify_request'])->name('again.verify.request'); //frontend
Route::post('/customer//email/verify/request/send/',[CustomerController::class, 'email_verify_requ_send'])->name('email.verify.requ.send'); //frontend






// =========Role Permission===========//
Route::get('/role',[RoleController::class, 'role'])->name('role')->middleware('auth');
Route::post('/permission/store/',[RoleController::class, 'permission_store'])->name('permission.store')->middleware('auth');
Route::post('/role/store/',[RoleController::class, 'role_store'])->name('role.store')->middleware('auth');
Route::post('/assign/role/',[RoleController::class, 'assign_role'])->name('assign.role')->middleware('auth');
Route::get('/remove/role/{user_id}', [RoleController::class, 'remove_role'])->name('remove.role')->middleware('auth');
Route::get('/remove/delete/{role_id}', [RoleController::class, 'role_delete'])->name('role.delete')->middleware('auth');


// ============Api Setup=============//
Route::get('/api',[ApiController::class, 'api'])->name('api')->middleware('auth');
Route::post('/update/bkash/api/',[ApiController::class, 'update_bkash_api'])->name('update.bkash.api')->middleware('auth');
Route::post('/update/aamarpay/api/',[ApiController::class, 'update_aamarpay_api'])->name('update.aamarpay.api')->middleware('auth');
Route::post('/update/stripe/api/',[ApiController::class, 'update_stripe'])->name('update.stripe')->middleware('auth');
Route::post('/bank/store/',[ApiController::class, 'bank_store'])->name('bank.store')->middleware('auth');
Route::get('/bank/delete/{bank_id}', [ApiController::class, 'bank_delete'])->name('bank.delete')->middleware('auth');
Route::get('/bank/status/{bank_id}', [ApiController::class, 'bank_status'])->name('bank.status')->middleware('auth');



// ==========Bkash ==========//
Route::group(['middleware' => ['web']], function () {
    // Payment Routes for bKash
    Route::get('/bkash/payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'index']);
    Route::get('/bkash/create-payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'createPayment'])->name('bkash-create-payment');
    Route::get('/bkash/callback', [App\Http\Controllers\BkashTokenizePaymentController::class,'callBack'])->name('bkash-callBack');



    //search payment
    Route::get('/bkash/search/{trxID}', [App\Http\Controllers\BkashTokenizePaymentController::class,'searchTnx'])->name('bkash-serach');

    
    //refund payment routes
    // Route::get('/bkash/refund', [App\Http\Controllers\BkashTokenizePaymentController::class,'refund'])->name('bkash-refund');
    // Route::get('/bkash/refund/status', [App\Http\Controllers\BkashTokenizePaymentController::class,'refundStatus'])->name('bkash-refund-status');

});

// =========Aamar Pay Payment Gateway=======//

// Route::get('/', function () {
//     return view('');
// });

Route::get('payment',[\App\Http\Controllers\paymentController::class,'payment'])->name('payment');

//You need declear your success & fail route in "app\Middleware\VerifyCsrfToken.php"
Route::post('success',[\App\Http\Controllers\paymentController::class,'success'])->name('success');
Route::post('fail',[\App\Http\Controllers\paymentController::class,'fail'])->name('fail');
Route::get('cancel',[\App\Http\Controllers\paymentController::class,'cancel'])->name('cancel');

// ===Strip Payment Gateway=====//
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Route::get('/email', function () {
    $recipientEmail = 'laraveldeveloper.bd@gmail.com';
    $message = 'Hello, World!';

    // Send the email with a basic text message
    $result = Mail::raw($message, function ($message) use ($recipientEmail) {
        $message->to($recipientEmail)->subject('Hello, World Email');
    });
    dd($result);
    return 'Email sent successfully with "Hello, World!" text.';
});