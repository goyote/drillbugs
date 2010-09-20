<article>
	<h2>Sign up</h2>

	<?= form::open() ?>

		<?php if ( ! empty($errors)): ?>
			<div class="errors">
				<?php foreach ($errors as $error): ?>
					<p><?= $error ?></p>
				<?php endforeach ?>
			</div>
		<?php endif ?>

		<p>
			<?= form::label('username') ?>:
			<?= form::input('username', HTML::chars($post['username']), array('id' => 'username')) ?>
		</p>

		<p>
			<?= form::label('email') ?>:
			<?= form::input('email', HTML::chars($post['email']), array('id' => 'email')) ?>
		</p>

		<p>
			<?= form::label('password') ?>:
			<?= form::password('password', '', array('id' => 'password')) ?>
		</p>

		<p>
			<?= form::label('password_confirm', 'Confirm password:') ?>
			<?= form::password('password_confirm', '', array('id' => 'password_confirm')) ?>
		</p>

		<p>
			<button>Sign up</button>
		</p>

	</form>
</article>
