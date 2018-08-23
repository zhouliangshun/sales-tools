<?php
	/**
	* 在为销售助手提供备份功能
	* 展示数据列表（客户列表，记录列表， 物品列表）
	*
	*
	*/
	/** WordPress Administration Bootstrap */
	?>


	<div class="wrap">

		<h1 class="wp-heading-inline"> <?=esc_html(get_admin_page_title()); ?> </h1>
		<a href="http://192.168.2.162/wp-admin/post-new.php"
				class="page-title-action">添加</a>
		<hr class="wp-header-end">



		<!-- 过滤 -->
		<h2 class="screen-reader-text">过滤</h2>
		<ul class="subsubsub">
		<!-- <li class="all"><a href="edit.php?post_type=post" class="current" aria-current="page">全部<span class="count">（1）</span></a> |</li> -->
		<!-- <li class="publish"><a href="edit.php?post_status=publish&post_type=post">已发布<span class="count">（1）</span></a></li>-->
		</ul>
	<form id="posts-filter" method="get">

		<p class="search-box">
			<label class="screen-reader-text" for="post-search-input">搜索:</label>
			<input type="search" id="post-search-input" name="s" value="">
			<input type="submit" id="search-submit" class="button" value="搜索文章">
		</p>

		<input type="hidden" name="post_status" class="post_status_page" value="all">
		<input type="hidden" name="post_type" class="post_type_page" value="post">
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="670b940202">
		<input type="hidden" name="_wp_http_referer" value="/wp-admin/edit.php">

		<div class="tablenav top">
			<div class="alignleft actions bulkactions">
				<label for="bulk-action-selector-top" class="screen-reader-text">选择批量操作</label>
				<select name="action" id="bulk-action-selector-top">
					<option value="-1">批量操作</option>
					<option value="edit" class="hide-if-no-js">编辑</option>
					<option value="trash">移至回收站</option>
					<select>
						<input type="submit" id="doaction" class="button action" value="应用">
					</div>
					<div class="alignleft actions">
						<label for="filter-by-date" class="screen-reader-text">按日期筛选</label>
						<select name="m" id="filter-by-date">
							<option selected="selected" value="0">全部日期</option>
							<option value="201805">2018年五月</option>
						</select>
						<label class="screen-reader-text" for="cat">按分类过滤</label>

						<select name="cat" id="cat" class="postform">
							<option value="0">所有分类目录</option>
							<option class="level-0" value="1">未分类</option>
						</select>
						<input type="submit" name="filter_action" id="post-query-submit"
							class="button" value="筛选">
					</div>
					<div class="tablenav-pages one-page">
						<span class="displaying-num">1个记录</span>
						<span class="pagination-links">
							<span class="tablenav-pages-navspan button disabled" aria-hidden="true">«</span>
							<span class="tablenav-pages-navspan button disabled" aria-hidden="true">‹</span>
							<span class="paging-input">第<label for="current-page-selector" class="screen-reader-text">当前页</label>
								<input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="1" aria-describedby="table-paging">
								<span class="tablenav-paging-text">页，共<span class="total-pages">1</span>页</span>
							</span>
							<span class="tablenav-pages-navspan button disabled" aria-hidden="true">›</span>
							<span class="tablenav-pages-navspan button disabled" aria-hidden="true">»</span>
						</span>
					</div>
					<br class="clear">
				</div>

				<h2 class="screen-reader-text">记录列表</h2>
				<table class="wp-list-table widefat fixed striped posts">
					<thead>
						<tr>
							<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">全选</label><inputid="cb-select-all-1" type="checkbox"></td>
							<th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href="http://192.168.2.162/wp-admin/edit.php?orderby=title&order=asc">
								<span>标题</span><spanclass="sorting-indicator"></span></a>
							</th>
							<th scope="col" id="author" class="manage-column column-author">用户</th>
							<th scope="col" id="date" class="manage-column column-date sortable asc">
								<a href="http://192.168.2.162/wp-admin/edit.php?orderby=date&order=desc"><span>日期</span><span class="sorting-indicator"></span></a>
							</th>
						 </tr>
					</thead>

					<tbody id="the-list">
						<tr id="post-1" class="iedit author-self level-0 post-1 type-post
							status-publish format-standard hentry category-uncategorized">
							<th scope="row" class="check-column"> <label class="screen-reader-text"
									for="cb-select-1">
									选择世界，您好！ </label>
								<input id="cb-select-1" type="checkbox" name="post[]" value="1">
								<div class="locked-indicator">
									<span class="locked-indicator-icon" aria-hidden="true"></span>
									<span class="screen-reader-text">
										“世界，您好！”已被锁定 </span>
								</div>
							</th><td class="title column-title has-row-actions column-primary
								page-title" data-colname="标题"><div class="locked-info"><span
										class="locked-avatar"></span> <span class="locked-text"></span></div>
								<strong><a class="row-title"
										href="http://192.168.2.162/wp-admin/post.php?post=1&action=edit"
										aria-label="“世界，您好！”（编辑）">世界，您好！</a></strong>

								<div class="hidden" id="inline_1">
									<div class="post_title">世界，您好！</div><div class="post_name">hello-world</div>
									<div class="post_author">1</div>
									<div class="comment_status">open</div>
									<div class="ping_status">open</div>
									<div class="_status">publish</div>
									<div class="jj">18</div>
									<div class="mm">05</div>
									<div class="aa">2018</div>
									<div class="hh">20</div>
									<div class="mn">02</div>
									<div class="ss">49</div>
									<div class="post_password"></div><div class="page_template">default</div><div
										class="post_category" id="category_1">1</div><div class="tags_input"
										id="post_tag_1"></div><div class="sticky"></div><div
										class="post_format"></div></div><div class="row-actions"><span
										class="edit"><a
											href="http://192.168.2.162/wp-admin/post.php?post=1&action=edit"
											aria-label="编辑“世界，您好！”">编辑</a> | </span><span class="inline
										hide-if-no-js"><button type="button" class="button-link editinline"
											aria-label="快速编辑“世界，您好！”" aria-expanded="false">快速编辑</button> |
									</span><span class="trash"><a
											href="http://192.168.2.162/wp-admin/post.php?post=1&action=trash&_wpnonce=74a69df3c2"
											class="submitdelete" aria-label="移动“世界，您好！”到垃圾箱">移至回收站</a> | </span><span
										class="view"><a
											href="http://192.168.2.162/index.php/2018/05/18/hello-world/"
											rel="bookmark" aria-label="查看“世界，您好！”">查看</a></span></div><button
									type="button" class="toggle-row"><span class="screen-reader-text">显示详情</span></button></td><td
								class="author column-author" data-colname="作者"><a
									href="edit.php?post_type=post&author=1">zhouliangshun</a></td><td
								class="categories column-categories" data-colname="分类目录"><a
									href="edit.php?category_name=uncategorized">未分类</a></td><td class="tags
								column-tags" data-colname="标签"><span aria-hidden="true">—</span><span
									class="screen-reader-text">没有标签</span></td><td class="comments
								column-comments" data-colname="评论"> <div class="post-com-count-wrapper">
									<a
										href="http://192.168.2.162/wp-admin/edit-comments.php?p=1&comment_status=approved"
										class="post-com-count post-com-count-approved"><span
											class="comment-count-approved" aria-hidden="true">1</span><span
											class="screen-reader-text">1条评论</span></a><span class="post-com-count
										post-com-count-pending post-com-count-no-pending"><span
											class="comment-count comment-count-no-pending" aria-hidden="true">0</span><span
											class="screen-reader-text">无待审评论</span></span> </div>
							</td><td class="date column-date" data-colname="日期">已发布<br><abbr
									title="2018/05/18 20:02:49">2小时前</abbr></td> </tr>
					</tbody>

					<tfoot>
						<tr>
							<td class="manage-column column-cb check-column"><label
									class="screen-reader-text" for="cb-select-all-2">全选</label><input
									id="cb-select-all-2" type="checkbox"></td><th scope="col"
								class="manage-column column-title column-primary sortable desc"><a
									href="http://192.168.2.162/wp-admin/edit.php?orderby=title&order=asc"><span>标题</span><span
										class="sorting-indicator"></span></a></th><th scope="col"
								class="manage-column column-author">作者</th><th scope="col"
								class="manage-column column-categories">分类目录</th><th scope="col"
								class="manage-column column-tags">标签</th><th scope="col"
								class="manage-column column-comments num sortable desc"><a
									href="http://192.168.2.162/wp-admin/edit.php?orderby=comment_count&order=asc"><span><span
											class="vers comment-grey-bubble" title="评论"><span
												class="screen-reader-text">评论</span></span></span><span
										class="sorting-indicator"></span></a></th><th scope="col"
								class="manage-column column-date sortable asc"><a
									href="http://192.168.2.162/wp-admin/edit.php?orderby=date&order=desc"><span>日期</span><span
										class="sorting-indicator"></span></a></th> </tr>
					</tfoot>

				</table>
				<div class="tablenav bottom">

					<div class="alignleft actions bulkactions">
						<label for="bulk-action-selector-bottom" class="screen-reader-text">选择批量操作</label><select
							name="action2" id="bulk-action-selector-bottom">
							<option value="-1">批量操作</option>
							<option value="edit" class="hide-if-no-js">编辑</option>
							<option value="trash">移至回收站</option>
						</select>
						<input type="submit" id="doaction2" class="button action" value="应用">
					</div>
					<div class="alignleft actions">
					</div>
					<div class="tablenav-pages one-page"><span class="displaying-num">1个项目</span>
						<span class="pagination-links"><span class="tablenav-pages-navspan button
								disabled" aria-hidden="true">«</span>
							<span class="tablenav-pages-navspan button disabled" aria-hidden="true">‹</span>
							<span class="screen-reader-text">当前页</span><span id="table-paging"
								class="paging-input"><span class="tablenav-paging-text">第1页，共<span
										class="total-pages">1</span>页</span></span>
							<span class="tablenav-pages-navspan button disabled" aria-hidden="true">›</span>
							<span class="tablenav-pages-navspan button disabled" aria-hidden="true">»</span></span></div>
					<br class="clear">
				</div>

			</form>


			<form method="get"><table style="display: none"><tbody id="inlineedit">

						<tr id="inline-edit" class="inline-edit-row inline-edit-row-post
							quick-edit-row quick-edit-row-post inline-edit-post"style="display:
							none"><td colspan="7" class="colspanchange">

								<fieldset class="inline-edit-col-left">
									<legend class="inline-edit-legend">快速编辑</legend>
									<div class="inline-edit-col">

										<label>
											<span class="title">标题</span>
											<span class="input-text-wrap"><input type="text" name="post_title"
													class="ptitle" value=""></span>
										</label>

										<label>
											<span class="title">别名</span>
											<span class="input-text-wrap"><input type="text" name="post_name"
													value=""></span>
										</label>


										<fieldset class="inline-edit-date">
											<legend><span class="title">日期</span></legend>
											<div class="timestamp-wrap"><label><span class="screen-reader-text">年</span><input
														type="text" name="aa" value="2018" size="4" maxlength="4"
														autocomplete="off"></label>-<label><span
														class="screen-reader-text">月</span><select name="mm">
														<option value="01" data-text="1月">1月</option>
														<option value="02" data-text="2月">2月</option>
														<option value="03" data-text="3月">3月</option>
														<option value="04" data-text="4月">4月</option>
														<option value="05" data-text="5月" selected="selected">5月</option>
														<option value="06" data-text="6月">6月</option>
														<option value="07" data-text="7月">7月</option>
														<option value="08" data-text="8月">8月</option>
														<option value="09" data-text="9月">9月</option>
														<option value="10" data-text="10月">10月</option>
														<option value="11" data-text="11月">11月</option>
														<option value="12" data-text="12月">12月</option>
													</select></label>-<label><span class="screen-reader-text">日</span><input
														type="text" name="jj" value="18" size="2" maxlength="2"
														autocomplete="off"></label> @ <label><span
														class="screen-reader-text">时</span><input type="text" name="hh"
														value="20" size="2" maxlength="2" autocomplete="off"></label>:<label><span
														class="screen-reader-text">分</span><input type="text" name="mn"
														value="02" size="2" maxlength="2" autocomplete="off"></label></div><input
												type="hidden" id="ss" name="ss" value="49"> </fieldset>
										<br class="clear">

										<label class="inline-edit-author"><span class="title">作者</span><select
												name="post_author" class="authors">
												<option value="1">zhouliangshun（zhouliangshun）</option>
											</select></label>
										<div class="inline-edit-group wp-clearfix">
											<label class="alignleft">
												<span class="title">密码</span>
												<span class="input-text-wrap"><input type="text"
														name="post_password" class="inline-edit-password-input" value=""></span>
											</label>

											<em class="alignleft inline-edit-or">
												–或– </em>
											<label class="alignleft inline-edit-private">
												<input type="checkbox" name="keep_private" value="private">
												<span class="checkbox-title">私密</span>
											</label>
										</div>


									</div></fieldset>


								<fieldset class="inline-edit-col-center inline-edit-categories"><div
										class="inline-edit-col">


										<span class="title inline-edit-categories-label">分类目录</span>
										<input type="hidden" name="post_category[]" value="0">
										<ul class="cat-checklist category-checklist">

											<li id="category-1" class="popular-category"><label class="selectit"><input
														value="1" type="checkbox" name="post_category[]"
														id="in-category-1"> 未分类</label></li>
										</ul>


									</div></fieldset>


								<fieldset class="inline-edit-col-right"><div class="inline-edit-col">
										<label class="inline-edit-tags">
											<span class="title">标签</span>
											<textarea data-wp-taxonomy="post_tag" cols="22" rows="1"
												name="tax_input[post_tag]" class="tax_input_post_tag"></textarea>
										</label>




										<div class="inline-edit-group wp-clearfix">
											<label class="alignleft">
												<input type="checkbox" name="comment_status" value="open">
												<span class="checkbox-title">允许评论</span>
											</label>
											<label class="alignleft">
												<input type="checkbox" name="ping_status" value="open">
												<span class="checkbox-title">允许ping</span>
											</label>
										</div>


										<div class="inline-edit-group wp-clearfix">
											<label class="inline-edit-status alignleft">
												<span class="title">状态</span>
												<select name="_status">
													<option value="publish">已发布</option>
													<option value="future">定时</option>
													<option value="pending">等待复审</option>
													<option value="draft">草稿</option>
												</select>
											</label>



											<label class="alignleft">
												<input type="checkbox" name="sticky" value="sticky">
												<span class="checkbox-title">置顶这篇文章</span>
											</label>



										</div>


									</div></fieldset>

								<div class="submit inline-edit-save">
									<button type="button" class="button cancel alignleft">取消</button>
									<input type="hidden" id="_inline_edit" name="_inline_edit"
										value="194430ed2a"> <button type="button" class="button button-primary
										save alignright">更新</button>
									<span class="spinner"></span>
									<input type="hidden" name="post_view" value="list">
									<input type="hidden" name="screen" value="edit-post">
									<br class="clear">
									<div class="notice notice-error notice-alt inline hidden">
										<p class="error"></p>
									</div>
								</div>
							</td></tr>

						<tr id="bulk-edit" class="inline-edit-row inline-edit-row-post
							bulk-edit-row bulk-edit-row-post bulk-edit-post"style="display: none"><td
								colspan="7" class="colspanchange">

								<fieldset class="inline-edit-col-left">
									<legend class="inline-edit-legend">批量编辑</legend>
									<div class="inline-edit-col">
										<div id="bulk-title-div">
											<div id="bulk-titles"></div>
										</div>




									</div></fieldset><fieldset class="inline-edit-col-center
									inline-edit-categories"><div class="inline-edit-col">


										<span class="title inline-edit-categories-label">分类目录</span>
										<input type="hidden" name="post_category[]" value="0">
										<ul class="cat-checklist category-checklist">

											<li id="category-1" class="popular-category"><label class="selectit"><input
														value="1" type="checkbox" name="post_category[]"
														id="in-category-1"> 未分类</label></li>
										</ul>


									</div></fieldset>


								<fieldset class="inline-edit-col-right"><label class="inline-edit-tags">
										<span class="title">标签</span>
										<textarea data-wp-taxonomy="post_tag" cols="22" rows="1"
											name="tax_input[post_tag]" class="tax_input_post_tag"></textarea>
									</label><div class="inline-edit-col">

										<label class="inline-edit-author"><span class="title">作者</span><select
												name="post_author" class="authors">
												<option value="-1">—无更改—</option>
												<option value="1">zhouliangshun（zhouliangshun）</option>
											</select></label>



										<div class="inline-edit-group wp-clearfix">
											<label class="alignleft">
												<span class="title">评论</span>
												<select name="comment_status">
													<option value="">—无更改—</option>
													<option value="open">允许</option>
													<option value="closed">不允许</option>
												</select>
											</label>
											<label class="alignright">
												<span class="title">Ping通告</span>
												<select name="ping_status">
													<option value="">—无更改—</option>
													<option value="open">允许</option>
													<option value="closed">不允许</option>
												</select>
											</label>
										</div>


										<div class="inline-edit-group wp-clearfix">
											<label class="inline-edit-status alignleft">
												<span class="title">状态</span>
												<select name="_status">
													<option value="-1">—无更改—</option>
													<option value="publish">已发布</option>

													<option value="private">私密</option>
													<option value="pending">等待复审</option>
													<option value="draft">草稿</option>
												</select>
											</label>



											<label class="alignright">
												<span class="title">置顶</span>
												<select name="sticky">
													<option value="-1">—无更改—</option>
													<option value="sticky">置顶</option>
													<option value="unsticky">不置顶</option>
												</select>
											</label>



										</div>

										<label class="alignleft">
											<span class="title">形式</span>
											<select name="post_format">
												<option value="-1">—无更改—</option>
												<option value="0">标准</option>
												<option value="aside">日志</option>
												<option value="image">图像</option>
												<option value="video">视频</option>
												<option value="quote">引语</option>
												<option value="link">链接</option>
												<option value="gallery">相册</option>
												<option value="audio">音频</option>
											</select></label>

									</div></fieldset>

								<div class="submit inline-edit-save">
									<button type="button" class="button cancel alignleft">取消</button>
									<input type="submit" name="bulk_edit" id="bulk_edit" class="button
										button-primary alignright" value="更新"> <input type="hidden"
										name="post_view" value="list">
									<input type="hidden" name="screen" value="edit-post">
									<br class="clear">
									<div class="notice notice-error notice-alt inline hidden">
										<p class="error"></p>
									</div>
								</div>
							</td></tr>
					</tbody></table></form>

			<div id="ajax-response"></div>
			<br class="clear">
		</div>