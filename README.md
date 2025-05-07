# Account Notification Handler

**Version:** 2.1.0  
**Author:** Keron Lewis (<keronlewis@live.com>)

A lightweight WordPress plugin for **Ultimate Member** that automates post-registration workflows based on a custom `account_type` field:

- **Cash Accounts**: Auto-approve, auto-login, redirect to homepage, and send a customizable welcome email.
- **Charge Accounts**: Keep pending, send a customizable credit-application email with optional attachment.

## Features

- Hooks into `um_registration_complete` to trigger actions.
- Admin settings page under **Settings → Account Notifications**:
  - **From Email**: Define sender address.
  - **Cash/Charge Subjects & Bodies**: Customize email templates with placeholders.
  - **Attachment Upload**: Use the Media Library to select a document for charge emails.
- Placeholder support:
  - `{first_name}`, `{last_name}`  
  - `{site_name}`, `{site_url}`
- Uses WordPress Settings API and Media Library.

## Installation

1. Upload the `account-notifications` folder to `/wp-content/plugins/`.
2. Activate **Account Notification Handler** in **Plugins**.
3. Go to **Settings → Account Notifications** and configure:
   - Sender address
   - Email templates
   - Optional attachment for charge accounts

## Usage

1. Create or edit your Ultimate Member registration form to include an **Account Type** dropdown (`data-key="account_type"`) with values `cash` and `charge`.
2. On form submission:
   - **Cash**: Approved, logged in, redirected, and emailed.
   - **Charge**: Left pending and emailed instructions.

## Placeholders

Within email bodies & subjects, use any of:
- `{first_name}` `{last_name}`  
- `{site_name}` `{site_url}`

Example subject: `Welcome to {site_name}`

## Changelog

**2.1.0**
- Added admin file uploader for custom attachments.

**2.0.0**
- Introduced Settings API for full template customization.

## License

GPL v2 or later
