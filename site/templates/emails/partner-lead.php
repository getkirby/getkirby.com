Name:
<?= $name . "\n" ?>

Type of customer:
<?= match ($customer) {
	'private'     => 'Private end user',
	'small'       => 'Small business',
	'mediumlarge' => 'Medium to large business',
	'agency'      => 'Agency looking for freelance support'
} . "\n" ?>

Company:
<?= $company . "\n" ?>

Contact:
<?= $email . "\n" ?>
<?= $contact . "\n" ?>

Project description:
<?= $project . "\n" ?>

Partner needed:
<?= $partner . "\n" ?>

Budget:
<?= $budget . "\n" ?>

Language:
<?= $language . "\n" ?>
