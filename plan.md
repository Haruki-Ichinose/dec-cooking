# dec-cooking / FamSync Implementation Plan

## Summary

`dec-cooking` will be reworked into **FamSync**, a family schedule and daily coordination app.

The project should no longer focus on cooking, recipes, or meal planning. The existing code already has stronger foundations for family operations:

- Family group creation.
- Family group participation.
- Family member list.
- Member status display.
- Calendar events.
- Family chat.

FamSync should answer a simple daily question: **Who is doing what today, where are they, and what does the family need to know?**

The portfolio value is **multi-tenant family data design, calendar event management, status sharing, chat, authorization, and practical dashboard UI**.

## Product Definition

### One-line Description

FamSync is a family schedule sharing app that keeps household members aligned through shared calendars, member status, and lightweight chat.

### Target Users

- Families that need a shared calendar.
- Households where members have different school, work, part-time job, and outing schedules.
- Parents and students who want to quickly know who is home, out, busy, or coming back late.
- Small household groups that need simple coordination without a heavy business tool.

### Demo Scenario

1. Log in as a demo family member.
2. Create or join a family group.
3. Open the dashboard and see today's family schedule.
4. Update your status to `out`, `home`, `busy`, or `late`.
5. Add a calendar event with title, date/time, location, memo, and related family member.
6. Open the family calendar and confirm the event.
7. Send a short message in family chat.
8. Confirm that only members of the same family can see the family's data.

## Current State

### Existing Strengths

- Laravel Breeze authentication exists.
- Users can create a family group.
- Users can join a family group.
- Users can view family members.
- There is a schedule model and FullCalendar-style endpoint.
- There is a chat model and basic chat screen.
- User records already have family-related columns.

### Gaps Before Portfolio Use

- README is still the default Laravel README.
- The app name and repository name still imply cooking.
- Routes are not consistently protected by auth middleware.
- Schedules are not scoped to a family.
- Chats are not scoped to a family.
- Member status is currently only a static select in the view.
- UI pages are fragmented and not product-like.
- There are typos and inconsistent route names.
- There are no feature tests for family isolation or schedule behavior.

## Development Rules

- Remove cooking, recipe, meal, and shopping-list scope from v1.
- Keep Laravel, Breeze, Blade, Tailwind, and the existing FullCalendar direction.
- Treat family as the tenant boundary.
- Every schedule, chat, and status should belong to a family.
- A user should only see data from their own family.
- Keep the app lightweight and personal, not enterprise project management.
- Prioritize dashboard clarity over feature count.

## Milestone 0: Repository Hygiene

Prepare the repository for the new product direction.

Tasks:

- Add this `plan.md`.
- Rewrite README around FamSync.
- Explain that the app is being redefined from cooking into family schedule sharing.
- Document existing models and planned tenant boundary.
- Confirm local setup steps.

Done:

- GitHub readers understand FamSync without reading old code.
- README links to this plan.

## Milestone 1: FamSync Branding

Make the product identity clear.

Tasks:

- Rename visible app text to `FamSync`.
- Replace the current welcome page with a family coordination landing page.
- Replace generic dashboard text with a FamSync dashboard.
- Rename navigation to `Today`, `Calendar`, `Family`, `Chat`, and `Profile`.
- Remove cooking-related wording from UI and README.
- Fix route typo `paticipate` and align naming around `join family`.

Done:

- The app no longer looks like a cooking app or Laravel default.
- The first screen communicates family schedule sharing.

## Milestone 2: Family Tenant Model

Make family the core data boundary.

Tasks:

- Keep existing `families` table but normalize usage.
- Add stable family join code or invite code instead of manually choosing numeric family IDs.
- Ensure each user belongs to at most one active family in v1.
- Add relationships:
  - Family has many users.
  - Family has many schedules.
  - Family has many chats.
  - User belongs to family.
- Add middleware or controller checks so family data is scoped to the authenticated user's family.

Done:

- A user cannot view or modify another family's schedules or chats.
- Family creation and joining are understandable and safe.

## Milestone 3: Member Status

Turn the static member status select into real data.

Tasks:

- Add member status fields to users or a dedicated `member_statuses` table.
- Use fixed statuses:
  - `home`
  - `out`
  - `busy`
  - `late`
  - `unavailable`
- Store optional status memo.
- Store status updated time.
- Add status update form on dashboard.
- Show each family member's current status on dashboard and family page.

Done:

- Family members can communicate availability without sending a chat message.
- Dashboard shows who is home, out, busy, late, or unavailable.

## Milestone 4: Family Calendar

Make schedules useful as household events.

Tasks:

- Add `family_id` to schedules.
- Add optional `user_id` for the related family member.
- Expand schedule fields:
  - `title`
  - `starts_at`
  - `ends_at`
  - `location`
  - `memo`
  - `event_type`
- Use event types:
  - `school`
  - `work`
  - `part_time`
  - `outing`
  - `family`
  - `other`
- Keep FullCalendar-compatible JSON endpoint.
- Add create, edit, and delete flows.
- Scope calendar events to the authenticated user's family.

Done:

- The family calendar can show who has what event and when.
- Calendar API does not leak other families' events.

## Milestone 5: Today Dashboard

Create the main product experience.

Tasks:

- Build a dashboard centered on today.
- Show today's events sorted by time.
- Show current member statuses.
- Show recent chat messages.
- Add quick actions:
  - update status
  - add schedule
  - open calendar
  - send chat
- Highlight late or unavailable members.

Done:

- A family member can open one screen and understand the household's current day.
- The dashboard is the primary demo screen.

## Milestone 6: Family Chat

Refine chat into a family-scoped message log.

Tasks:

- Add `family_id` to chats.
- Use authenticated user name instead of free-form `user_name`.
- Store `user_id` for each chat message.
- Show latest messages on dashboard.
- Add chat list page.
- Scope chat messages to the user's family.
- Validate message length.

Done:

- Family chat works as a lightweight coordination tool.
- Users cannot post as someone else by typing a fake name.

## Milestone 7: Notifications And Reminders

Add practical reminders without overbuilding.

Initial implementation should be in-app only.

Tasks:

- Add upcoming event reminder list.
- Show events happening today and tomorrow.
- Show events without assigned member.
- Add dashboard warning when no family group is joined.
- Keep email, push, and LINE notifications out of v1.

Done:

- The app helps users notice relevant schedule items.
- Reminder logic is testable without external notification services.

## Milestone 8: Portfolio Finish

Make the project presentable.

Tasks:

- Add `DemoSeeder` with two families, multiple users, schedules, statuses, and chats.
- Add README sections:
  - problem setting
  - why cooking was removed from scope
  - tenant design
  - family calendar workflow
  - member status workflow
  - demo steps
  - screenshots
  - future work
- Add feature tests:
  - family creation
  - family join
  - family-scoped schedule visibility
  - status update
  - chat creation
  - cross-family access prevention
- Add a 3-minute demo script.

Done:

- The repository reads as a family schedule sharing product.
- `php artisan test` passes.
- Demo data can be reproduced from seeders.

## Deployment Policy

FamSync is a portfolio demo, not a formally released consumer service.

- Deploy a demo environment so reviewers can operate the app.
- Use demo users and seeded family data by default.
- Do not accept real household data as an intended production workflow.
- Keep external notifications, invite links, and privacy-sensitive integrations out of the demo release.
- Present the app as a working prototype that demonstrates family-scoped scheduling, status sharing, and chat.

## Future Ideas

- Email or push reminders.
- LINE notification integration.
- Shared household tasks.
- Recurring schedules.
- Calendar color customization by member.
- File or image attachment for events.
- Location map links.
- Child/parent role permissions.
- Temporary invite links.
- Mobile-first PWA experience.

## Public Routes

Target routes:

- `/`: landing page
- `/dashboard`: today dashboard
- `/families/create`: create family
- `/families/join`: join family
- `/family`: family member list
- `/status`: update member status
- `/calendar`: family calendar
- `/schedules`: schedule list
- `/schedules/create`: create schedule
- `/schedules/{schedule}/edit`: edit schedule
- `/chat`: family chat
- `/profile`: profile

Compatibility:

- Existing routes may remain temporarily, but product-facing routes should use FamSync naming.

## Test Plan

Feature tests:

- Guest users are redirected from family dashboard.
- Authenticated user can create a family.
- Authenticated user can join a family with a valid join code.
- User can update their own status.
- User can create a family schedule.
- User can edit and delete a schedule in their own family.
- User cannot see another family's schedule.
- User can send a family chat message.
- User cannot see another family's chat messages.
- Dashboard shows today's family events and member statuses.

Unit tests:

- Family/user relationships.
- Schedule date range filtering.
- Member status label mapping.
- Family-scoped query helpers.

Manual verification:

- `php artisan migrate:fresh --seed`
- Log in as demo family member.
- Create or join family.
- Update member status.
- Add today's schedule.
- Send chat message.
- Confirm dashboard shows today's events, statuses, and recent chat.

## Assumptions

- Cooking, recipes, meal planning, and shopping lists are out of scope for v1.
- The app should focus on family schedule sharing and daily coordination.
- Family is the tenant boundary.
- A user belongs to one family in v1.
- External notifications are future work.
- FamSync should be a smaller lifestyle/productivity portfolio app, below `dec-camjyo` and `dec-laratter` in priority.
