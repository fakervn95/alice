<?php 
/*
Template Name: page-template-mortgage
*/
get_header(); 
?>	


	<div class="g_content">
		<?php echo do_shortcode('[sc_breadcrumb]'); ?>
		<div class="container">
			<div class="wrap_mortgage">
				<p align="center"><a href="https://www.mortgagecalculator.org/"><img src="https://www.mortgagecalculator.org/images/mortgage-calculator-logo.png" width="589" height="57" alt="MortgageCalculator.org" border="0" style="max-width: 100%;" target="_blank"></a></p> <iframe src="https://www.mortgagecalculator.org/webmasters/?downpayment=50000&homevalue=300000&loanamount=250000&interestrate=4&loanterm=30&propertytax=2400&pmi=1&homeinsurance=1000&monthlyhoa=0" style="width: 100%; height: 1200px; border: 0;"></iframe>
			</div>
		</div>
	</div>
	<?php get_footer(); ?>