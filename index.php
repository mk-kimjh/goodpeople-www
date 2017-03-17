<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); ?>
<link href="/css/main.css" rel="stylesheet">
<link href="/css/flags/flag-icon.css" rel="stylesheet">
</head>
<body>
    
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/skipnav.php'); ?>
    <div id="wrapper">
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/header.php'); ?>
        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/sidebar.php'); ?>
        <main id="content">
			<?
			$sql = " select * from ".$site_prefix."banner where bloc = 'M' and bstatus = 'Y' order by border desc ";
			$result = sql_query($sql);
			for($i=0;$row = sql_fetch_array($result);$i++){
				if(!$row["blink"]){
					$row["blink"] = "javascript:;";
				} else {
					if(!preg_match("/http\:/i",$row["blink"])){
					//	$row["blink"] = "http://".$row["blink"];
					}
				}
				$blist[$i] = $row;
				$blist[$i]["files"] = get_file($site_prefix."banner",$row["idx"]);
			}

			$sql = $result = $row = "";
			?>
            <div class="events">
                <div class="tabs">
                    <div class="container">
                        <ul class="nav" role="tablist">
							<?
							$j=1;
							for($i=0;$i<sizeof($blist);$i++){
							?>
                            <li role="presentation" <?=$i==0?' class="active"':""?>>
                                <a href="#event-<?=$j?>" aria-controls="event-<?=$j?>" role="tab" data-toggle="tab">
                                    <i></i>
                                    <span class="sr-only"><?=$blist[$i]["btxt4"]?></span>
                                </a>
                            </li>
							<? 
								$j++;
							}
							?>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
					<?
					$j=1;
					for($i=0;$i<sizeof($blist);$i++){
					?>
                    <section role="tabpanel" class="tab-pane <?=$i==0?"active":""?>" id="event-<?=$j?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h1><?=set_text($blist[$i]["btxt1"])?></h1>
                                    <p style="color:#<?=$blist[$i]["btxtcolor"]?>"><?=$blist[$i]["btxt2"]?></p>
                                    <p><?=set_text($blist[$i]["btxt3"])?></p>
                                    <a class="more<?=$blist[$i]["btnstyle"]?>" href="<?=$blist[$i]["blink"]?>">자세히보기<i class="icon-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <style>
						/* 모바일용 이미지 */
						.events #event-<?=$j?> { background-image:url(<?=$blist[$i]["files"][0]["path"]?>/<?=$blist[$i]["files"][0]["file_source"]?>); }
						/* 웹용 이미지 */
						@media (min-width: 768px) {
							.events #event-<?=$j?> { background-image:url(<?=$blist[$i]["files"][0]["path"]?>/<?=$blist[$i]["files"][0]["file_source"]?>); }
						}
					</style>
					<?
						$j++;
					}
					?>
                </div>
            </div>
            <div class="communities">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <section>
                                <h1>굿피플 소식</h1>
                                <ul>
									<?
									$latest_code = "003002";
									$sql = " select * from tb_board where CODE = '".$latest_code."' and STATUS_YN = 'Y' order by WDATE desc limit 0, 4 ";
									$result = sql_query($sql);
									$latest_cnt = @mysql_num_rows($result);
									for($i=0;$row = sql_fetch_array($result);$i++){
									?>
                                    <li><a href="/community/news/view.php?seqno=<?=$row["SEQNO"]?>&page=1&p_part=&p_item=&code=<?=$latest_code?>"><?=cut_string($row["TITLE"],60)?> <time datetime="<?=substr($row["WDATE"],2,8)?>"><?=substr($row["WDATE"],2,8)?></time></a></li>
									<?
									}
									if($latest_cnt == 0) echo "<li><a href='javascript:;'>등록된 게시물이 없습니다.</a></li>";
									$latest_code = $sql = $result = $latest_cnt = $row = "";
									?>
                                </ul>
                                <a class="btn-more" href="/community/news/list.php">더보기<i class="icon-angle-right"></i></a>
                            </section>
                        </div>
                        <div class="col-sm-4 hidden-xs">
                            <section>
                                <h1>미디어 소식</h1>
                                <ul>
									<?
									$latest_code = "003003";
									$sql = " select * from tb_board where CODE = '".$latest_code."' and STATUS_YN = 'Y' order by WDATE desc limit 0, 4 ";
									$result = sql_query($sql);
									$latest_cnt = @mysql_num_rows($result);
									for($i=0;$row = sql_fetch_array($result);$i++){
									?>
                                    <li><a href="/community/press/view.php?seqno=<?=$row["SEQNO"]?>&page=1&p_part=&p_item=&code=<?=$latest_code?>"><?=cut_string($row["TITLE"],60)?> <time datetime="<?=substr($row["WDATE"],2,8)?>"><?=substr($row["WDATE"],2,8)?></time></a></li>
									<?
									}
									if($latest_cnt == 0) echo "<li><a href='javascript:;'>등록된 게시물이 없습니다.</a></li>";
									$latest_code = $sql = $result = $latest_cnt = $row = "";
									?>
                                </ul>
                                <a class="btn-more" href="/community/press/list.php">더보기<i class="icon-angle-right"></i></a>
                            </section>
                        </div>
                        <div class="col-sm-4 hidden-xs">
                            <section>
                                <h1>아동 후원 스토리</h1>
                                <ul>
									<?
									$latest_code = "003018";
									$sql = " select * from tb_board where CODE = '".$latest_code."' and STATUS_YN = 'Y' order by WDATE desc limit 0, 4 ";
									$result = sql_query($sql);
									$latest_cnt = @mysql_num_rows($result);
									for($i=0;$row = sql_fetch_array($result);$i++){
									?>
                                    <li><a href="/relationship/story_view.php?seqno=<?=$row["SEQNO"]?>&page=1&p_part=&p_item=&code=<?=$latest_code?>"><?=cut_string($row["TITLE"],60)?> <time datetime="<?=substr($row["WDATE"],2,8)?>"><?=substr($row["WDATE"],2,8)?></time></a></li>
									<?
									}
									if($latest_cnt == 0) echo "<li><a href='javascript:;'>등록된 게시물이 없습니다.</a></li>";
									$latest_code = $sql = $result = $latest_cnt = $row = "";
									?>
                                </ul>
                                <a class="btn-more" href="/relationship/story_list.php">더보기<i class="icon-angle-right"></i></a>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sponsorship">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-7 col-lg-6">
                            <section class="ars">
                                <div>
                                    <h1><i>ARS</i> 060-700-1544</h1>
                                    <p>건당 <i>10,000</i>원</p>
                                </div>
                            </section>
                        </div>
                        <div class="col-sm-5 col-lg-6">
                            <section class="join">
                                <div class="donate">
                                    <h1 style="font-weight:normal;font-size:34px;">후원하기</h1>
                                    <ul>
                                        <li>모금함</li>
                                        <li class="bar" role="presentation">|</li>
                                        <li>나눔파트너</li>
                                        <li class="bar" role="presentation">|</li>
                                        <li>자원봉사</li>
                                    </ul>
                                    <div class="btn-area">
                                        <div class="regular">
                                            <a href="/sponsor/regular.php">정기 후원하기</a>
                                        </div>
                                        <div class="once">
                                            <a href="/sponsor/once.php">일시 후원하기</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="children">
                                    <h1 style="font-weight:normal;font-size:34px;">아동 후원</h1>
                                    <p>세상에서 가장 특별한 만남</p>
                                    <div class="btn-area">
                                        <div class="alliance">
                                            <a href="/relationship/children_intro.php">아동후원 <i>참여하기</i><i class="icon-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="contact">
                                <h1 style="font-weight:normal;font-size:34px;">후원문의 <i>1577-3034</i></h1>
                                <dl style="margin-top:30px;">
                                    <dt style="font-weight:normal;">후원계좌</dt>
                                    <dd style="margin-left:20px;">우리은행</dd>
                                    <dd class="bar" role="presentation">|</dd>
                                    <dd>1005-303-017200 (사)굿피플인터내셔널</dd>
                                </dl>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <section class="share-media">
				<?
				$movies = get_main_movie();
				?>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <h1>영상나눔</h1>
                            <div class="embed-responsive embed-responsive-16by9">
								<iframe id="media-embed" class="embed-responsive-item" src="<?=$movies[0]["MOVIE"]?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3">
                            <div class="thumbs">
                                <button class="btn-control btn-prev" type="button">
                                    <img class="img-responsive" src="/images/main/ico_arrow_left.png" alt="이전">
                                </button>
                                <ul>
									<? for($i=0;$i<sizeof($movies);$i++){ ?>
                                    <li <?=$i==0?'class="active"':''?>><a href="<?=$movies[$i]["MOVIE"]?>"><img class="img-responsive" src="<?=$movies[$i]["thumbs"]?>" alt="썸네일1" style="max-width:200px;height:100%;"><span></span></a></li>
									<? } ?>
                                </ul>
                                <button class="btn-control btn-next" type="button">
                                    <img class="img-responsive" src="/images/main/ico_arrow_right.png" alt="다음">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="partners">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2 col-sm-10 col-sm-offset-1">
                            <h1 class="sr-only">파트너</h1>
                            <div class="banners">
                                <button class="btn btn-link btn-prev" type="button"><i class="icon-angle-left"></i></button>
                                <ul>
									<?
									$sql = " select * from ".$site_prefix."partner where use_yn = 'Y' order by porder desc, idx desc ";
									$result = sql_query($sql);
									for($i=0;$row = sql_fetch_array($result);$i++){
										$row["files"] = get_file($site_prefix."partner",$row["idx"]);
										echo '<li><a href="'.$row["plink"].'" target="_blank"><img src="/board/upload/gppartner/'.$row["files"][0]["file_source"].'" alt="'.$row["pname"].'"></a></li>';
									}
									?>
                                </ul>
                                <button class="btn btn-link btn-next" type="button"><i class="icon-angle-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="market">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="shortcuts">
                                <section class="shortcut shortcut-1">
                                    <a class="icon hidden-sm hidden-md hidden-lg" href="/sponsor/market/introduce.php">
                                        <i>사랑의 가게</i>
                                    </a>
                                    <div class="hidden-xs">
                                        <h1>사랑의 가게</h1>
                                        <p>우리의 사랑 나눔은 아이들의 삶과 지구촌 이웃들에게 기적을 만드는 작은 시작입니다.</p>
                                        <a class="more" href="/sponsor/market/introduce.php">더보기<i class="icon-angle-right"></i></a>
                                    </div>
                                </section>
                                <section class="shortcut shortcut-2">
                                    <a class="icon hidden-sm hidden-md hidden-lg" href="/community/talk/list.php">
                                        <i>희망토크</i>
                                    </a>
                                    <div class="hidden-xs">
                                        <h1>희망토크</h1>
                                        <p>따뜻한 말과 함께 전하는 행복한 마음입니다. 후원자님들의 따뜻한 마음을 자유롭게 나누어주세요.</p>
                                        <a class="more" href="/community/talk/list.php">더보기<i class="icon-angle-right"></i></a>
                                    </div>
                                </section>
                                <section class="shortcut shortcut-3">
                                    <a class="icon hidden-sm hidden-md hidden-lg" href="/community/story/list.php">
                                        <i>나도 굿피플</i>
                                    </a>
                                    <div class="hidden-xs">
                                        <h1>나도 굿피플</h1>
                                        <p>굿피플과 함께 나누는 아름다운 사람들의 생생한 이야기를 전해드립니다.</p>
                                        <a class="more" href="/community/story/list.php">더보기<i class="icon-angle-right"></i></a>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
							<?
							$blist = "";
							$sql = " select * from ".$site_prefix."banner where bloc = 'MB' and bstatus = 'Y' order by border desc ";
							$result = sql_query($sql);
							for($i=0;$row = sql_fetch_array($result);$i++){
								if(!$row["blink"]){
									$row["blink"] = "javascript:;";
								} else {
									if(!preg_match("/http\:/i",$row["blink"])){
									//	$row["blink"] = "http://".$row["blink"];
									}
								}
								$blist[$i] = $row;
								$blist[$i]["files"] = get_file($site_prefix."banner",$row["idx"]);
							}

							$sql = $result = $row = "";
							?>
                            <div class="banners">
                                <ul>
									<? for($i=0;$i<sizeof($blist);$i++){ ?>
                                    <li><a href="<?=$blist[$i]["blink"]?>" target="<?=$blist[$i]["btarget"]?>"><img src="<?=$blist[$i]["files"][0]["path"]?>/<?=$blist[$i]["files"][0]["file_source"]?>" alt="배너1"></a></li>
									<? } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="corporation hidden-xs">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-8 col-md-6">
                            <section class="donate">
                                <h1 class="sr-only">후원하기</h1>
                                <div class="account">
                                    <p class="number">우리은행<br><i>1005-301-568033</i></p>
                                    <p class="holder">사회복지법인<br>굿피플인터내셔널</p>
                                </div>
                            </section>
                        </div>
                        <div class="col-xs-4 col-md-6">
                            <section class="news">
                                <h1>사회복지법인 소식</h1>
                                <ul>
                                    <li><a href="#">굿피플 채용 공고 <time datetime="2015-07-08">15-07-08</time></a></li>
                                    <li><a href="#">ACTs for HOPE 희망나눔 파트너 협약식 개최 <time datetime="2015-07-08">15-07-08</time></a></li>
                                    <li><a href="#">순복음강남교회, 네팔 대지진 성금 전달식 <time datetime="2015-07-08">15-07-08</time></a></li>
                                    <li><a href="#">2015년 제4회 후원자 필드트립 연기 안내 <time datetime="2015-07-08">15-07-08</time></a></li>
                                </ul>
                                <a class="more" href="#">더보기<i class="icon-angle-right"></i></a>
                            </section>
                        </div>
                    </div>
                </div>
            </div> -->
        </main>
		<!-- Modal -->
		<div class="modal fade" id="video-modal" tabindex="-1" role="dialog" aria-labelledby="">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="embed-responsive embed-responsive-16by9">
							<!-- <video autoplay>
								<source src="/video/park_video.mp4" type="video/mp4">
								브라우저가 비디오 태그를 지원하지 않습니다.
							</video> -->
							<iframe class="embed-responsive-item" width="900" height="506" src="https://www.youtube.com/embed/UksQhLeJ2qI?rel=0&amp;showinfo=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docjs.php'); ?>
    <script src="/js/lib/jquery.bxslider.min.js"></script>
    <script src="/js/app/main.js"></script>
    <script>
		$(window).on('load', function() {
			if ($(window).width() >= 1280) {
				$('#video-modal').modal('show');
			}
		});
		$('#video-modal').on('hidden.bs.modal', function (e) {
			$('#video-modal .embed-responsive-item').remove();
		});
	</script>
</body>
</html>