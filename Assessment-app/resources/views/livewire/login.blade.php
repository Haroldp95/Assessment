<div>
    <form wire:submit.prevent="login">
        <input type="email" wire:model="email" placeholder="Email" required>
        <input type="password" wire:model="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
</div>
