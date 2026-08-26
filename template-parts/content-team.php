<?php
/**
 * Template part for displaying team page content
 *
 * @package Limadia_Entity_Foundation_V1
 */

// Query published team members from CPT
$team_query = new WP_Query( array(
	'post_type'      => 'team_member',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => array(
		'menu_order' => 'ASC',
		'date'       => 'ASC',
	),
) );

$team_members = array();

if ( $team_query->have_posts() ) {
	while ( $team_query->have_posts() ) {
		$team_query->the_post();
		$post_id   = get_the_ID();
		$thumb_url = get_the_post_thumbnail_url( $post_id, 'full' );
		$role      = get_post_meta( $post_id, '_member_role', true );
		$bio       = get_post_meta( $post_id, '_member_bio', true );
		
		if ( empty( $bio ) ) {
			$bio = get_the_excerpt();
			if ( empty( $bio ) ) {
				$bio = wp_trim_words( wp_strip_all_tags( get_the_content() ), 30 );
			}
		}

		$social = array();
		$linkedin = get_post_meta( $post_id, '_member_linkedin', true );
		$twitter  = get_post_meta( $post_id, '_member_twitter', true );
		$facebook = get_post_meta( $post_id, '_member_facebook', true );
		$instagram= get_post_meta( $post_id, '_member_instagram', true );
		$email    = get_post_meta( $post_id, '_member_email', true );

		if ( ! empty( $linkedin ) )  $social['linkedin']  = $linkedin;
		if ( ! empty( $twitter ) )   $social['twitter']   = $twitter;
		if ( ! empty( $facebook ) )  $social['facebook']  = $facebook;
		if ( ! empty( $instagram ) ) $social['instagram'] = $instagram;
		if ( ! empty( $email ) )     $social['envelope']  = 'mailto:' . antispambot( $email );

		$team_members[] = array(
			'name'   => get_the_title(),
			'role'   => ! empty( $role ) ? $role : __( 'Team Member', 'limadia-entity-foundation-v1' ),
			'image'  => ! empty( $thumb_url ) ? $thumb_url : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&h=600&q=80',
			'bio'    => $bio,
			'social' => $social,
		);
	}
	wp_reset_postdata();
}

// Fallback dummy members if no CPT entries have been published yet
if ( empty( $team_members ) ) {
	$team_members = apply_filters( 'limadia_team_members', array(
		array(
			'name'   => 'Kwame Mensah',
			'role'   => 'Executive Director & Founder',
			'image'  => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&h=600&q=80',
			'bio'    => 'Dedicated to community empowerment and social equity, Kwame brings over 15 years of humanitarian leadership and strategic development to champion child development and elderly care across Ghana.',
			'social' => array(
				'linkedin' => '#',
				'twitter'  => '#',
				'envelope' => 'mailto:kwame@limadiafoundation.org',
			),
		),
		array(
			'name'   => 'Dr. Abena Osei',
			'role'   => 'Head of Health & Dementia Care',
			'image'  => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&h=600&q=80',
			'bio'    => 'A public health specialist and geriatrics advocate leading our specialized initiatives for seniors, dementia patient care, and preventive healthcare outreach in underserved rural communities.',
			'social' => array(
				'linkedin' => '#',
				'twitter'  => '#',
				'envelope' => 'mailto:abena@limadiafoundation.org',
			),
		),
		array(
			'name'   => 'Emmanuel Boateng',
			'role'   => 'Director of Operations & Strategy',
			'image'  => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&h=600&q=80',
			'bio'    => 'Oversees grassroots logistics, infrastructure monitoring, and programmatic execution to ensure maximum transparency, efficiency, and real-world impact across all foundation campaigns.',
			'social' => array(
				'linkedin' => '#',
				'twitter'  => '#',
				'envelope' => 'mailto:emmanuel@limadiafoundation.org',
			),
		),
		array(
			'name'   => 'Akosua Serwaa',
			'role'   => 'Youth & Education Program Lead',
			'image'  => 'https://images.unsplash.com/photo-1580894732444-8ecded7900cd?auto=format&fit=crop&w=600&h=600&q=80',
			'bio'    => 'Passionate about child literacy and youth mentorship, Akosua designs educational support frameworks, school supply drives, and extracurricular skill development for underprivileged children.',
			'social' => array(
				'linkedin' => '#',
				'twitter'  => '#',
				'envelope' => 'mailto:akosua@limadiafoundation.org',
			),
		),
		array(
			'name'   => 'Kofi Addo',
			'role'   => 'Advocacy & Governance Specialist',
			'image'  => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=600&h=600&q=80',
			'bio'    => 'Directs our civic engagement efforts, anti-corruption awareness campaigns, and policy research advocating for equitable infrastructure distribution and transparent governance.',
			'social' => array(
				'linkedin' => '#',
				'twitter'  => '#',
				'envelope' => 'mailto:kofi@limadiafoundation.org',
			),
		),
		array(
			'name'   => 'Nana Ama Frimpong',
			'role'   => 'Community Outreach & Volunteer Lead',
			'image'  => 'https://images.unsplash.com/photo-1567532939604-b6b5b0db2604?auto=format&fit=crop&w=600&h=600&q=80',
			'bio'    => 'Coordinates our nationwide network of passionate volunteers, organizing community workshops, health screenings, and immediate emergency relief response programs.',
			'social' => array(
				'linkedin' => '#',
				'twitter'  => '#',
				'envelope' => 'mailto:nanaama@limadiafoundation.org',
			),
		),
		array(
			'name'   => 'Samuel Arthur',
			'role'   => 'Finance & Compliance Officer',
			'image'  => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=600&h=600&q=80',
			'bio'    => 'Guarantees donor accountability, strict fiscal governance, and audit compliance so that every contribution directly impacts the beneficiaries who need it most.',
			'social' => array(
				'linkedin' => '#',
				'twitter'  => '#',
				'envelope' => 'mailto:samuel@limadiafoundation.org',
			),
		),
		array(
			'name'   => 'Grace Appiah',
			'role'   => 'Communications & Partnerships Lead',
			'image'  => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?auto=format&fit=crop&w=600&h=600&q=80',
			'bio'    => 'Manages institutional partnerships, donor communications, and storytelling initiatives that spotlight community voices and amplify the foundation’s mission globally.',
			'social' => array(
				'linkedin' => '#',
				'twitter'  => '#',
				'envelope' => 'mailto:grace@limadiafoundation.org',
			),
		),
	) );
}
?>

<!-- Section: Inner Header -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo esc_url( get_template_directory_uri() . '/images/bg2.jpg' ); ?>">
	<div class="container pt-40 pb-40">
		<div class="section-content text-center">
			<div class="row"> 
				<div class="col-md-8 col-md-offset-2 text-center">
					<h2 class="text-theme-colored font-36 font-weight-700 text-uppercase mb-5">Our Team</h2>
					<ol class="breadcrumb text-center mt-10 white">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
						<li class="active">Team</li>
					</ol>
				</div>
			</div>
		</div>
	</div>      
</section>

<!-- Section: Team Introduction -->
<section class="bg-lightest">
	<div class="container pt-70 pb-40">
		<div class="section-title text-center">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h2 class="text-uppercase mt-0 line-height-1">Meet The <span class="text-theme-colored">Limadia Team</span></h2>
					<div class="title-icon">
						<i class="flaticon-charity-hand-holding-a-heart"></i>
					</div>
					<p class="font-15 text-gray-darkgray mt-15">
						Our team combines passionate community organizers, healthcare advocates, educators, and governance professionals united by a singular purpose: driving measurable, sustainable transformation in Ghanaian communities.
					</p>
				</div>
			</div>
		</div>

		<!-- Team Members Grid -->
		<div class="section-content">
			<div class="row multi-row-clearfix">
				<?php foreach ( $team_members as $member ) : ?>
					<div class="col-xs-12 col-sm-6 col-md-3 mb-40">
						<div class="team-member-card bg-white border-1px p-15" style="border-radius: 6px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); height: 100%; display: flex; flex-direction: column;">
							<div class="thumb position-relative" style="overflow: hidden; border-radius: 4px;">
								<img 
									src="<?php echo esc_url( $member['image'] ); ?>" 
									alt="<?php echo esc_attr( $member['name'] ); ?>" 
									class="img-fullwidth img-responsive"
									style="width: 100%; height: 260px; object-fit: cover; object-position: top center; transition: transform 0.4s ease;"
									onmouseover="this.style.transform='scale(1.05)'"
									onmouseout="this.style.transform='scale(1)'"
								>
							</div>
							<div class="info pt-20 pb-10 text-center" style="display: flex; flex-direction: column; flex-grow: 1;">
								<h4 class="name font-18 font-weight-700 mt-0 mb-5">
									<span class="text-dark"><?php echo esc_html( $member['name'] ); ?></span>
								</h4>
								<h6 class="occupation font-12 text-theme-colored font-weight-600 text-uppercase mt-0 mb-15" style="letter-spacing: 0.5px;">
									<?php echo esc_html( $member['role'] ); ?>
								</h6>
								<p class="bio font-13 text-gray lineheight-20 mb-20 text-left" style="flex-grow: 1;">
									<?php echo esc_html( $member['bio'] ); ?>
								</p>
								<div class="card-footer-social border-top-1px pt-15 mt-auto">
									<ul class="styled-icons icon-sm icon-dark icon-theme-colored icon-circled m-0">
										<?php if ( ! empty( $member['social']['linkedin'] ) ) : ?>
											<li><a href="<?php echo esc_url( $member['social']['linkedin'] ); ?>" target="_blank" rel="noopener noreferrer" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
										<?php endif; ?>
										<?php if ( ! empty( $member['social']['twitter'] ) ) : ?>
											<li><a href="<?php echo esc_url( $member['social']['twitter'] ); ?>" target="_blank" rel="noopener noreferrer" title="Twitter / X"><i class="fa fa-twitter"></i></a></li>
										<?php endif; ?>
										<?php if ( ! empty( $member['social']['facebook'] ) ) : ?>
											<li><a href="<?php echo esc_url( $member['social']['facebook'] ); ?>" target="_blank" rel="noopener noreferrer" title="Facebook"><i class="fa fa-facebook"></i></a></li>
										<?php endif; ?>
										<?php if ( ! empty( $member['social']['instagram'] ) ) : ?>
											<li><a href="<?php echo esc_url( $member['social']['instagram'] ); ?>" target="_blank" rel="noopener noreferrer" title="Instagram"><i class="fa fa-instagram"></i></a></li>
										<?php endif; ?>
										<?php if ( ! empty( $member['social']['envelope'] ) ) : ?>
											<li><a href="<?php echo esc_url( $member['social']['envelope'] ); ?>" title="Email"><i class="fa fa-envelope"></i></a></li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<!-- Section: Core Values -->
<section class="bg-white">
	<div class="container pt-70 pb-50">
		<div class="section-title text-center">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h2 class="text-uppercase mt-0 line-height-1">Our Guiding <span class="text-theme-colored">Pillars</span></h2>
					<p class="font-15 text-gray mt-10">The values that steer every decision, partnership, and outreach initiative we undertake.</p>
				</div>
			</div>
		</div>
		<div class="section-content">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-3 mb-30">
					<div class="icon-box iconbox-theme-colored text-center p-20 border-1px bg-lightest" style="border-radius: 6px; min-height: 220px;">
						<a class="icon icon-bordered icon-circled icon-md mb-15">
							<i class="fa fa-heart font-28 text-theme-colored"></i>
						</a>
						<h4 class="icon-box-title font-16 font-weight-700 mt-0">Compassion & Dignity</h4>
						<p class="font-13 text-gray m-0">Serving vulnerable children and the elderly with utmost empathy, care, and respect.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 mb-30">
					<div class="icon-box iconbox-theme-colored text-center p-20 border-1px bg-lightest" style="border-radius: 6px; min-height: 220px;">
						<a class="icon icon-bordered icon-circled icon-md mb-15">
							<i class="fa fa-shield font-28 text-theme-colored"></i>
						</a>
						<h4 class="icon-box-title font-16 font-weight-700 mt-0">Integrity & Accountability</h4>
						<p class="font-13 text-gray m-0">Maintaining unwavering transparency with donor funds, project milestones, and governance.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 mb-30">
					<div class="icon-box iconbox-theme-colored text-center p-20 border-1px bg-lightest" style="border-radius: 6px; min-height: 220px;">
						<a class="icon icon-bordered icon-circled icon-md mb-15">
							<i class="fa fa-users font-28 text-theme-colored"></i>
						</a>
						<h4 class="icon-box-title font-16 font-weight-700 mt-0">Community First</h4>
						<p class="font-13 text-gray m-0">Listening directly to local community members to design solutions tailored to real needs.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 mb-30">
					<div class="icon-box iconbox-theme-colored text-center p-20 border-1px bg-lightest" style="border-radius: 6px; min-height: 220px;">
						<a class="icon icon-bordered icon-circled icon-md mb-15">
							<i class="fa fa-leaf font-28 text-theme-colored"></i>
						</a>
						<h4 class="icon-box-title font-16 font-weight-700 mt-0">Sustainable Impact</h4>
						<p class="font-13 text-gray m-0">Creating lasting systems, healthcare routines, and educational foundations that endure.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Section: Call To Action (Join Our Team / Volunteer) -->
<section class="divider parallax layer-overlay overlay-deep" data-stellar-background-ratio="0.5" data-bg-img="<?php echo esc_url( get_template_directory_uri() . '/images/bg1.jpg' ); ?>">
	<div class="container pt-70 pb-70">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center text-white">
				<h3 class="text-white font-32 font-weight-700 text-uppercase mt-0">Want to Work or Volunteer with Us?</h3>
				<p class="font-16 text-white mb-30">We are always eager to connect with mission-driven individuals who want to contribute their skills to education, healthcare, and advocacy in Ghana.</p>
				<div class="cta-buttons">
					<a href="<?php echo esc_url( home_url( '/careers' ) ); ?>" class="btn btn-colored btn-theme-colored btn-lg font-14 font-weight-600 mr-15">Explore Careers</a>
					<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-default btn-transparent btn-bordered btn-lg font-14 font-weight-600">Contact Us</a>
				</div>
			</div>
		</div>
	</div>
</section>
