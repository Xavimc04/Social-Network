<div class="form">  
    <input type="email" placeholder="Email" name="email" wire:model="email">
    <input type="text" maxlength="20" placeholder="Username" name="username" wire:model="username">
    <input type="password" placeholder="Password" name="password" wire:model="password">
    <input type="password" placeholder="Repeat password" wire:model="repeated">

    <div>
        <input type="date" class="dob" wire:model="dob">

        <select wire:model="sex">
            <option value="m">Male</option>
            <option value="f">Female</option>
            <option value="o">Other</option>
        </select>
    </div>

    <div>
        <input id="terms" type="checkbox" wire:model="terms" required>
        <label for="terms">I acknowledge that I have read and accept the <span class="color">Terms of Use Agreement</span>, and consent to the <span class="color">Privacy Policy</span> and Video <span class="color">Privacy Policy</span></label>
    </div>

    <input type="submit" value="Submit" {{ !$terms ? 'disabled' : '' }} wire:click="register">
</div> 