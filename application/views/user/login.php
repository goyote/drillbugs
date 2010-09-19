<article>
	<h2>Sign in</h2>

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
			<?= form::input('username', Html::chars($post['username'])) ?>
		</p>

		<p>
			<?= form::label('password') ?>:
			<?= form::password('password') ?>
		</p>

		<p>
			<label>
				<?= Form::checkbox('remember') ?> Remember me
			</label>
		</p>

		<p>
			<button>Sign in</button>
		</p>
	
	</form>

	<a href="/user/forgot_password">Forgot password?</a>
</article>
